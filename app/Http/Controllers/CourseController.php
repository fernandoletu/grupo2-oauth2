<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function getAll(Request $request)
    {
        $estado = 0;
        $mensaje = "";
        $excepcion = "";
        $datos = "";
        $pagTotal = 0;
        $pagActual = 0;
        $pagTotalItems = 0;
        $statusCode = 200;

        $estadoError1 = "Error";
        $estadoError0 = "No se recibieron todos los parámetros requeridos";
        $estadoOk1 = "Ok";

        try {
            //Validator
            $valRules = [
                'nroPagina' => 'numeric|sometimes',
                'nombre' => 'string|max:100|sometimes'
            ];
            $validator = Validator::make($request->all(), $valRules);

            if ($validator->fails()) {
                $estado = 0;
                $mensaje = $estadoError0;
                $excepcion = [
                    'validationErrors' => $validator->errors()->messages()
                ];
                $statusCode = 400;
                return;
            } else {
                $cantPorPag = 10;
                $nroPagina = ($request->has('nroPagina') ? intval($request->input('nroPagina')) : 1);

                //FiltroNombre
                $filtroNombre = null;
                if ($request->has('nombre')) {
                    $filtroNombre = $request->input('nombre');
                }

                $listaBD = Course::select('id', 'nombre', 'descripcion', 'created_at')
                    ->when($filtroNombre != null, function ($query) use ($filtroNombre) {
                        $query->where('nombre', 'LIKE', "%{$filtroNombre}%");
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate($cantPorPag, ['*'], 'page', $nroPagina);

                //Datos de paginado
                $pagTotalItems = $listaBD->total();
                $pagTotal = ceil($pagTotalItems / $cantPorPag);
                $pagActual = $nroPagina;

                $listaDevolver = collect();
                if ($listaBD->count() > 0) {
                    foreach ($listaBD as $item) {
                        $listaDevolver->push([
                            'id' => $item->id,
                            'nombre' => $item->nombre,
                            'descripcion' => $item->descripcion,
                            'creado' => Carbon::parse($item->created_at)->toDateTimeString()
                        ]);
                    }
                }

                $estado = 1;
                $mensaje = $estadoOk1;
                $excepcion = "";
                $datos = [
                    'pagTotal' => $pagTotal,
                    'pagActual' => $pagActual,
                    'pagTotalItems' => $pagTotalItems,
                    'datos' => $listaDevolver->count() > 0 ? $listaDevolver : null
                ];
                $statusCode = 200;
            }
        } catch (\Exception $e) {
            $estado = -1;
            $mensaje = "Excepción al ejecutar";
            $excepcion = env('APP_DEBUG') ? $e->getMessage() : "Error";
            $statusCode = 500;
        } finally {
            return response()->json([
                'estado' => $estado,
                'mensaje' => $mensaje,
                'excepcion' => $excepcion,
                'datos' => $datos
            ], $statusCode);
        }
    }

    public function getData(Request $request)
    {
        $estado = 0;
        $mensaje = "";
        $excepcion = "";
        $datos = "";
        $statusCode = 200;

        $estadoError2 = "Elemento no encontrado";
        $estadoError1 = "Error";
        $estadoError0 = "No se recibieron todos los parámetros requeridos";
        $estadoOk1 = "Ok";

        try {
            $valRules = [
                'id' => 'numeric|min:1|required'
            ];
            $validator = Validator::make($request->all(), $valRules);

            if ($validator->fails()) {
                $estado = 0;
                $mensaje = $estadoError0;
                $excepcion = [
                    'validationErrors' => $validator->errors()->messages()
                ];
                $statusCode = 400;
                return;
            } else {
                $id = $request->input('id');

                $objBD = Course::find($id);

                if (!$objBD) {
                    $estado = -2;
                    $mensaje = $estadoError2;
                    $excepcion = "Error";
                    $statusCode = 404;
                    return;
                }

                $objDevolver = [
                    'id' => $objBD->id,
                    'nombre' => $objBD->nombre,
                    'descripcion' => $objBD->descripcion
                ];

                $estado = 1;
                $mensaje = $estadoOk1;
                $excepcion = "";
                $datos = $objDevolver;
                $statusCode = 200;
            }
        } catch (\Exception $e) {
            $estado = -1;
            $mensaje = "Excepción al ejecutar";
            $excepcion = env('APP_DEBUG') ? $e->getMessage() : $estadoError1;
            $statusCode = 500;
        } finally {
            return response()->json([
                'estado' => $estado,
                'mensaje' => $mensaje,
                'excepcion' => $excepcion,
                'datos' => $datos
            ], $statusCode);
        }
    }

    public function postCreate(Request $request)
    {
        $estado = 0;
        $mensaje = "";
        $excepcion = "";
        $datos = "";
        $statusCode = 200;

        $estadoError2 = "El nombre ya existe";
        $estadoError1 = "Error";
        $estadoError0 = "No se recibieron todos los parámetros requeridos";
        $estadoOk1 = "Ok";

        DB::beginTransaction();

        try {
            $valRules = [
                'nombre' => 'string|max:100|required',
                'descripcion' => 'string|sometimes'
            ];
            $validator = Validator::make($request->all(), $valRules);

            if ($validator->fails()) {
                $estado = 0;
                $mensaje = $estadoError0;
                $excepcion = [
                    'validationErrors' => $validator->errors()->messages()
                ];
                $statusCode = 400;
                return;
            } else {
                $nombre = trim($request->input('nombre'));
                $descripcion = $request->has('descripcion') ? trim($request->input('nombre')) : null;

                //Valida existencia de nombre
                $valExiste = Course::where('nombre', $nombre)
                    ->exists();

                if ($valExiste) {
                    $estado = -2;
                    $mensaje = $estadoError2;
                    $excepcion = "Error";
                    $statusCode = 404;
                    return;
                }

                $objNuevo = new Course();
                $objNuevo->nombre = $nombre;
                $objNuevo->descripcion = $descripcion;
                $objNuevo->save();

                DB::commit();

                $estado = 1;
                $mensaje = $estadoOk1;
                $excepcion = "";
                $datos = $objNuevo->id;
                $statusCode = 201;
            }
        } catch (\Exception $e) {
            DB::rollback();

            $estado = -1;
            $mensaje = "Excepción al ejecutar";
            $excepcion = env('APP_DEBUG') ? $e->getMessage() : $estadoError1;
            $statusCode = 500;
        } finally {
            return response()->json([
                'estado' => $estado,
                'mensaje' => $mensaje,
                'excepcion' => $excepcion,
                'datos' => $datos
            ], $statusCode);
        }
    }

    public function putUpdate(Request $request)
    {
        $estado = 0;
        $mensaje = "";
        $excepcion = "";
        $datos = "";
        $statusCode = 200;

        $estadoError3 = "El nombre ya existe";
        $estadoError2 = "Elemento no encontrado";
        $estadoError1 = "Error";
        $estadoError0 = "No se recibieron todos los parámetros requeridos";
        $estadoOk1 = "Ok";

        DB::beginTransaction();

        try {
            $valRules = [
                'id' => 'numeric|min:1|required',
                'nombre' => 'string|max:100|required',
                'descripcion' => 'string|sometimes'
            ];
            $validator = Validator::make($request->all(), $valRules);

            if ($validator->fails()) {
                $estado = 0;
                $mensaje = $estadoError0;
                $excepcion = [
                    'validationErrors' => $validator->errors()->messages()
                ];
                $statusCode = 400;
                return;
            } else {
                $id = $request->input('id');
                $nombre = trim($request->input('nombre'));
                $descripcion = $request->has('descripcion') ? trim($request->input('nombre')) : null;

                $objBD = Course::find($id);

                if (!$objBD) {
                    $estado = -2;
                    $mensaje = $estadoError2;
                    $excepcion = "Error";
                    $statusCode = 404;
                    return;
                }

                //Valida que no se repita nombre
                $valExiste = Course::where('id', '!=', $id)
                    ->where('nombre', $nombre)
                    ->exists();

                if ($valExiste) {
                    $estado = -3;
                    $mensaje = $estadoError3;
                    $excepcion = "Error";
                    $statusCode = 404;
                    return;
                }

                $objBD->nombre = $nombre;
                $objBD->descripcion = $descripcion;
                $objBD->save();

                DB::commit();

                $estado = 1;
                $mensaje = $estadoOk1;
                $excepcion = "";
                $datos = "";
                $statusCode = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();

            $estado = -1;
            $mensaje = "Excepción al ejecutar";
            $excepcion = env('APP_DEBUG') ? $e->getMessage() : $estadoError1;
            $statusCode = 500;
        } finally {
            return response()->json([
                'estado' => $estado,
                'mensaje' => $mensaje,
                'excepcion' => $excepcion,
                'datos' => $datos
            ], $statusCode);
        }
    }

    public function deleteDelete(Request $request)
    {
        $estado = 0;
        $mensaje = "";
        $excepcion = "";
        $datos = "";
        $statusCode = 200;

        $estadoError2 = "Elemento no encontrado";
        $estadoError1 = "Error";
        $estadoError0 = "No se recibieron todos los parámetros requeridos";
        $estadoOk1 = "Ok";

        DB::beginTransaction();

        try {
            $valRules = [
                'id' => 'numeric|min:1|required'
            ];
            $validator = Validator::make($request->all(), $valRules);

            if ($validator->fails()) {
                $estado = 0;
                $mensaje = $estadoError0;
                $excepcion = [
                    'validationErrors' => $validator->errors()->messages()
                ];
                $statusCode = 400;
                return;
            } else {
                $id = $request->input('id');

                $objBD = Course::find($id);

                if (!$objBD) {
                    $estado = -2;
                    $mensaje = $estadoError2;
                    $excepcion = "Error";
                    $statusCode = 404;
                    return;
                }

                $objBD->save();

                $objBD->delete();

                DB::commit();

                $estado = 1;
                $mensaje = $estadoOk1;
                $excepcion = "";
                $datos = "";
                $statusCode = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();

            $estado = -1;
            $mensaje = "Excepción al ejecutar";
            $excepcion = env('APP_DEBUG') ? $e->getMessage() : $estadoError1;
            $statusCode = 500;
        } finally {
            return response()->json([
                'estado' => $estado,
                'mensaje' => $mensaje,
                'excepcion' => $excepcion,
                'datos' => $datos
            ], $statusCode);
        }
    }
}
