<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_notas extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		  $this->control_session->verifyLoginOnHome();
		 $this->load->library('grocery_CRUD');
      }
	
	public function index()
	{
		$pAno=$this->input->post('cbx_grado',TRUE)."";
		$pSeccion=$this->input->post('rbt_seccion',TRUE)."";
		$pAlumno=$this->input->post('txt_search',TRUE)."";
		$this->load->model("abm/abm_alumno_model");
		$this->load->model("abm/abm_subject_model");
		$data['cursos'] = $this->abm_subject_model->listarSubjects();
		$data['alumnos'] = $this->abm_alumno_model->buscarAlumno($pAlumno,$pAno,$pSeccion);
		$this->load->view("abm/abm_notas",$data);
	}
	
	public function insert()
	{
		$pBimester	= $this->input->post('bimester',TRUE)."";
		$pSubject	= $this->input->post('subject',TRUE)."";
		$pGrado		= $this->input->post('grade',TRUE)."";
		$pSeccion	= $this->input->post('section',TRUE)."";
		$pAlumnos	= $this->input->post('alumno');
		$pNotas		= $this->input->post('notas');
		$alumnNotas	= array_merge($pAlumnos,$pNotas);
		$this->load->model("abm/abm_record_model");
		$countArray = count($pAlumnos);
		if(intval($pBimester)==1){
			for($i=0;$i<$countArray;$i++){
				$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject, $pBimester, $pNotas[$i]);
				echo $string."<br />";
			}
		}
		else{
			for($i=0;$i<$countArray;$i++){
				$idRecord = $this->abm_record_model->verify_record($pAlumnos[$i], $pGrado, $pSeccion, $pSubject);
				$string = $this->abm_record_model->update_notas($idRecord,$pAlumnos[$i], $pGrado, $pSeccion, $pSubject, $pBimester, $pNotas[$i]);
				echo $string." Updated<br />";
			}			
		}
		
	}
	
	public function insert_excel()
	{
		$pBimester  = 1;
		//$pGrado		= $this->input->post('grade',TRUE)."";
		//$pSeccion	= $this->input->post('section',TRUE)."";
		$pGrado		= 3;
		$pSeccion	= "A";
		$pAlumnos	= $this->input->post('alumnos');
		$pN1		= $this->input->post('notas1');
		$pN2		= $this->input->post('notas2');
		$pN3		= $this->input->post('notas3');
		$pN4		= $this->input->post('notas4');
		$pN5		= $this->input->post('notas5');
		$pN6		= $this->input->post('notas6');
		$pN7		= $this->input->post('notas7');
		$pN8		= $this->input->post('notas8');
		$pN9		= $this->input->post('notas9');
		$pN10		= $this->input->post('notas10');
		$pN11		= $this->input->post('notas11');
		$pSubject1	= 3;
		$pSubject2	= 8;
		$pSubject3	= 12;
		$pSubject4	= 13;
		$pSubject5	= 2;
		$pSubject6	= 7;
		$pSubject7	= 1;
		$pSubject8	= 5;
		$pSubject9	= 6;
		$pSubject10	= 4;
		$pSubject11	= 14;
		
		$this->load->model("abm/abm_record_model");
		//print_r($pAlumnos);
		$countArray = count($pAlumnos);
			//if(intval($pBimester)==1){
				for($i=0;$i<$countArray;$i++){
					//$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$id 	= $this->buscar_alumno_apellidos(utf8_encode("".$pAlumnos[$i].""), $pGrado, $pSeccion);
					echo '<h2>'.$id.'</h2>';
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject1, $pBimester, $pN1[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject2, $pBimester, $pN2[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject3, $pBimester, $pN3[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject4, $pBimester, $pN4[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject5, $pBimester, $pN5[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject6, $pBimester, $pN6[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject7, $pBimester, $pN7[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject8, $pBimester, $pN8[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject9, $pBimester, $pN9[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject10, $pBimester, $pN10[$i]);
					$string = $this->abm_record_model->insertar_notas($id, $pGrado, $pSeccion, $pSubject11, $pBimester, $pN11[$i]);
					echo $string."<br />";
				}
				/*for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject2, $pBimester, $pN2[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject3, $pBimester, $pN3[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject4, $pBimester, $pN4[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject5, $pBimester, $pN5[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject6, $pBimester, $pN6[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject7, $pBimester, $pN7[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject8, $pBimester, $pN8[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject9, $pBimester, $pN9[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject10, $pBimester, $pN10[$i]);
					echo $string."<br />";
				}
				for($i=0;$i<$countArray;$i++){
				$pAlumnos[$i] = $this->buscar_alumno_apellidos($pAlumnos[$i], $pGrado, $pSeccion);
					$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject11, $pBimester, $pN11[$i]);
					echo $string."<br />";
				}*/
			//}
			//else{
				//for($i=0;$i<$countArray;$i++){
				//	$idRecord = $this->abm_record_model->verify_record($pAlumnos[$i], $pGrado, $pSeccion, $pSubject);
					//$string = $this->abm_record_model->update_notas($idRecord,$pAlumnos[$i], $pGrado, $pSeccion, $pSubject.$ij."", $pBimester, $pN.$ij."");
					//echo $string." Updated<br />";
			//	}			
			//}	
		
	}

	public function buscar_alumno_apellidos($pAlumno,$pAno,$pSeccion){
		$this->load->model("abm/abm_alumno_model");
		$id = $this->abm_alumno_model->buscar_alumno_retorna_id($pAlumno,$pAno,$pSeccion);
		return $id;
	}
	
	public function director()
	{
		$pAno=$this->input->post('cbx_grado',TRUE)."";
		$pSeccion=$this->input->post('rbt_seccion',TRUE)."";
		$pAlumno=$this->input->post('txt_search',TRUE)."";
		$this->load->model("abm/abm_alumno_model");
		$this->load->model("abm/abm_subject_model");
		$data['cursos'] = $this->abm_subject_model->listarSubjects();
		$data['alumnos'] = $this->abm_alumno_model->buscarAlumno($pAlumno,$pAno,$pSeccion);
		$this->load->view("abm/abm_notas_director",$data);
	}

}