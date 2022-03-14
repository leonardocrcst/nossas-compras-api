<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Responses\Created;
use App\Http\Controllers\Responses\CreateError;
use App\Http\Controllers\Responses\Responses;
use App\Http\Controllers\Responses\Trashed;
use App\Http\Controllers\Responses\UnCreated;
use App\Http\Controllers\Responses\Unknown;
use App\Http\Controllers\Responses\UnTrashed;
use App\Http\Controllers\Responses\UnUpdate;
use App\Http\Controllers\Responses\Updated;
use App\Http\Controllers\Responses\UpdateError;
use App\Http\Resources\UsuariosResource;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class UsuariosController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = $this->getList(new Usuarios());
        return UsuariosResource::collection($this->setPagination($data, $request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Responses
     */
    public function create(): Responses
    {
        return parent::getCreate(new Usuarios());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Responses
     */
    public function store(Request $request): Responses
    {
        $model = new Usuarios();
        if($this->setStoreData($model, $request)) {
            $model->password = password_hash($model->password, CRYPT_BLOWFISH);
            try {
                $model->saveOrFail();
                return new Created("usuário(a)");
            } catch (Throwable $exception) {
                return new CreateError("usuário(a)", $exception->getCode(), ["error" => "Usuário(a) já registrado(a)."]);
            }
        } else {
            return new UnCreated("usuário(a)", null, $this->response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Responses
     */
    public function show(int $id): Responses
    {
        $model = Usuarios::find($id);
        if(!is_null($model)) {
            return new Responses($model->get(), 200, [], "data");
        }
        return new Unknown("usuário");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Responses
     */
    public function edit(int $id): Responses
    {
        $model = Usuarios::find($id);
        if(!is_null($model)) {
            return $this->getCreate($model);
        }
        return new Unknown("usuário");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Responses
     */
    public function update(Request $request, int $id): Responses
    {
        $model = Usuarios::find($id);
        if(is_null($model)) {
            return new Unknown("Usuário(a)");
        } elseif($this->setUpdateData($model, $request)) {
            if(!is_null($model->password)) {
                $model->password = password_hash($model->password, CRYPT_BLOWFISH);
            }
            try {
                $model->updateOrFail();
                return new Updated("Usuário");
            } catch (Throwable $exception) {
                return new UpdateError("usuário", $exception->getCode(), $this->response);
            }
        } else {
            return new UnUpdate("usuário");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Responses
     */
    public function destroy(int $id): Responses
    {
        $model = Usuarios::find($id);
        if(!is_null($model)) {
            if (is_null($model->disabled_at)) {
                $model->disabled_at = date('Y-m-d H:i:s');
                $model->update();
                return new Trashed("Usuário(a)");
            } else {
                try {
                    $model->delete();
                    return new Trashed("Usuário(a)");
                } catch (Throwable $exception) {
                    return new UnTrashed("usuário.");
                }
            }
        }
        return new Unknown("Usuário");
    }
}
