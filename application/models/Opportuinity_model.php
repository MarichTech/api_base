<?php
    class Opportuinity_model extends CI_Model{

        public function _construct(){
            $this->load->database();
        }

       

        public function get_opportuinities($id = FALSE){
            // Check if id has been passed(not null/empty)
            if($id === FALSE){
                //If id is not empty get single opportunities by name
                $this->db->order_by('opportunities.id','DESC');
                $query = $this->db->get_where('opportunities', array('user_id' => $this->session->userdata('user_id')));
                return $query->result_array();
            }

             //If id is empty all opportunities
            $query = $this->db->get_where('opportunities', array('id' => $id));
            return $query->row_array();
        }

        public function get_account_opportuinities($id){
          
            $query = $this->db->get_where('opportunities', array('account_id' => $id));
            return $query->result_array();
        }

        public function create_opportunity($data){
            //Create an array to hold opportunity details we want to store in db
           

            return $this->db->insert('opportunities', $data);
        }

        public function create_opportunity_pop(){
            //Create an array to hold opportunity details we want to store in db
            $data = array(
                //Format 'name_of_db_column' => data you want to store in the column(you can use post to get data from form)
                'account_id'=> $this->input->post('accountId'),
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'stage' => $this->input->post('stage')
            );

            return $this->db->insert('opportunities', $data);
        }

        public function delete_opportunity($id){
            //Delete an opportunity from db using passed id
            return $this->db->delete('opportunities', ['id' => $id]);
        }

         public function update_opportunity(){
           //Create an array to hold opportunity details we want to store in db
           $data = array(
            //Format 'name_of_db_column' => data you want to store in the column(you can use post to get data from form)
            'user_id' => $this->session->userdata('user_id'),
            'name' => $this->input->post('name'),
            'amount' => $this->input->post('amount'),
            'stage' => $this->input->post('stage')

           );
           //Update data by the use of passed id
           $this->db->where('id', $this->input->post('id'));
           return $this->db->update('opportunities', $data);
        }



    }
    ?>