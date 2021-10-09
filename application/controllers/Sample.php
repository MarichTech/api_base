<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;

    class Sample extends RestController{
        public function index_get(){

            $data['opportuinity'] = $this->opportuinity_model->get_opportuinities();
            $data['accounts'] = $this->account_model->get_accounts();
           
            if(empty($data['opportuinity']))
            {
                $this->response([
                    'status' => false,
                    'message' => 'OPPORTUNITIES NOT FOUND'
                ], RestController::HTTP_NOT_FOUND);
            }
            else
            {
                $this->response($data, 200);
                
            }
        }

        public function view_get($id = NULL){

            $data['opportuinity'] = $this->opportuinity_model->get_opportuinities($id);
            $data['accounts'] = $this->account_model->get_accounts();

            if(empty($data['opportuinity']))
            {
                $this->response([
                    'status' => false,
                    'message' => 'OPPORTUNITIES NOT FOUND'
                ], RestController::HTTP_NOT_FOUND);
            }
            else
            {
                $this->response($data, 200);
                
            }


        }

        
        public function createPopup_post(){

                //If form is valid
                //Create Account
                $result = $this->opportuinity_model->create_opportunity_pop();

                if($result > 0)
                {
                    $this->response([
                        'status' => true,
                        'message' => 'NEW OPPORTUNITY CREATED'
                    ], RestController::HTTP_OK); 
                }
                else
                {
                    $this->response([
                        'status' => false,
                        'message' => 'FAILED TO CREATE NEW OPPORTUNITY'
                    ], RestController::HTTP_BAD_REQUEST);
                } 


            
        }

        public function create_post(){

            $data = array(
                //Format 'name_of_db_column' => data you want to store in the column(you can use post to get data from form)
                'account_id'=> $this->input->post('account_id'),
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'stage' => $this->input->post('stage')
            );


                $result = $this->opportuinity_model->create_opportunity($data);

                
                
                if($result > 0)
                {
                    $this->response([
                        'status' => true,
                        'message' => 'NEW OPPORTUNITY CREATED'
                    ], RestController::HTTP_OK); 
                }
                else
                {
                    $this->response([
                        'status' => false,
                        'message' => 'FAILED TO CREATE NEW OPPORTUNITY'
                    ], RestController::HTTP_BAD_REQUEST);
                } 

                
            
        }

        public function delete_delete($id){
        
            //Delete Account
            $result = $this->opportuinity_model->delete_opportunity($id);

            if($result > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'OPPORTUNITY DELETED'
                ], RestController::HTTP_OK); 
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'FAILED TO DELETE OPPORTUNITY'
                ], RestController::HTTP_BAD_REQUEST);
            }

        }

        public function edit_get($id){
       
            $result = $this->opportuinity_model->get_opportuinities($id);

            if($result > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'FETCHED OPPORTUNITY'
                ], RestController::HTTP_OK); 
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'FAILED TO FETCH OPPORTUNITY'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }


        public function update_put(){

            $result = $this->opportuinity_model->update_opportunity();

            if($result > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'OPPORTUNITY UPDATED'
                ], RestController::HTTP_OK); 
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'FAILED TO UPDATE OPPORTUNITY'
                ], RestController::HTTP_BAD_REQUEST);
            }

        }

   

    }