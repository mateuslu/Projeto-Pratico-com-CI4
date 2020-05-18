<?php namespace App\Controllers;


use App\Models\LoginModel;

class Login extends BaseController
{
	public function index()
	{
		$data = [
			'titulo' => 'Login no Sistema!'
		];
		return view('login/index', $data);
	}

	//--------------------------------------------------------------------

    public function cadastro()
	{
		$data = [
			'titulo' => 'Cadastre-se!'
		];
		return view('login/cadastro', $data);
	}

	public function cadastroAcao()
	{
		helper('form');
		
		$validation = \Config\Services::validation();
		$validation->setRules([
			'txtNome' => ['label' => 'Nome', 'rules' => 'required|min_length[5]'],
			'txtEmail' => ['label' => 'Email', 'rules' => 'required|valid_email'],
			'txtSenha' => ['label' => 'Senha', 'rules' => 'required|min_length[6]']
		]);

		if(! $validation->withRequest($this->request)->run()){
			$data = [
				'titulo' => 'Cadastre-se!'
			];
			return view('login/cadastro', $data); 
		}else{

			$senha = password_hash(
				$this->request->getPost('txtSenha'),
				PASSWORD_DEFAULT,
				['cost' => '8']
			);
			//echo $senha;

			$data = [
				'nome' => $this->request->getPost('txtNome'),
				'email' => $this->request->getPost('txtEmail'),
				'senha' => $senha,
				'nivel' => 'Usuario'
			];

			$LoginModel = new LoginModel(); 

			if($LoginModel->save($data)){
				$this->session->setFlashdata('sucesso','Cadastro realizado com sucesso!');
			}else{
				$this->session->setFlashdata('erro','Não foi possivel realizar o cadastro!');

			}

			 //return redirect()->to(base_url("login/cadastro"));
			 return $this->index();

		}
		



	}
}
