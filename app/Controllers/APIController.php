<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController {
    protected $modelName = 'App\Models\ModeloPersonas';
    protected $format    = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }


    public function insertar(){

        //1. Recibir los datos desde el cliente
		$nombre=$this->request->getPost("nombre");
		$edad=$this->request->getPost("edad");
		$cedula=$this->request->getPost("cedula");
		$poblacion=$this->request->getPost("poblacion");
		$descripcion=$this->request->getPost("descripcion");
        $foto=$this->request->getPost("foto");

        //2. Organizar los datos que llegan de las vistas
		// en un arreglo asociativo 
		//(las claves deben ser iguales a los campos o atributos de la tabla en BD)
		$datosEnvio=array(
			"nombre"=>$nombre,
			"edad"=>$edad,
			"cedula"=>$cedula,
			"poblacion"=>$poblacion,
			"descripcion"=>$descripcion,
			"foto"=>$foto
        );
        
        //3. Utilizar el atributo this->validate del controlador para validar datos
        if($this->validate('usuarioPOST')){

            $id=$this->model->insert($datosEnvio);
            return $this->respond($this->model->find($id));

        }else{

            $validation =  \Config\Services::validation();
            return $this->respond($validation->getErrors());

        }

        




    }


}