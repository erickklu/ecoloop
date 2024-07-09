<?php

namespace App\VoyagerActions;

use TCG\Voyager\Actions\AbstractAction;

class RequestedEntryAction extends AbstractAction
{

    public function getTitle()
    {
        return ' Ver Publicación';
    }

    public function getIcon()
    {
        return 'voyager-file-text';
    }

    public function getPolicy()
    {
        return;
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success',
        ];
    }

    public function getDefaultRoute()
    {
        return route('publicaciones.detalle', ["id" => $this->data->entry_id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'requested_entries';
    }
}


class RequestedEntryUserAction extends AbstractAction
{

    public function getTitle()
    {
        return ' Ver Usuario';
    }

    public function getIcon()
    {
        return 'voyager-person';
    }

    public function getPolicy()
    {
        return;
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary',
        ];
    }

    public function getDefaultRoute()
    {
        return route('perfil', ["id" => $this->data->user_id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'requested_entries';
    }
}



class RequestedEntryAcceptAction extends AbstractAction
{

    public function getTitle()
    {
        return $this->data->{'state'}=="PENDIENTE"?'Confirmar Solicitud':'Cambiar a Pendiente';
    }

    public function getIcon()
    {
        return $this->data->{'state'}=="PENDIENTE"?'voyager-check':'voyager-external';
    }


    public function getPolicy()
    {
        return;
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-warning',
        ];
    }

    public function getDefaultRoute()
    {
        return route('soli', ["requestedEntry" => $this->data->id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'requested_entries';
    }
}
