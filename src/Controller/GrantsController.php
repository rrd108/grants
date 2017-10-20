<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grants Controller
 *
 * @property \App\Model\Table\GrantsTable $Grants
 *
 * @method \App\Model\Entity\Grant[] paginate($object = null, array $settings = [])
 */
class GrantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Issuers']
        ];
        $grants = $this->paginate($this->Grants);

        $this->set(compact('grants'));
        $this->set('_serialize', ['grants']);
    }

    /**
     * View method
     *
     * @param string|null $id Grant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grant = $this->Grants->get($id, [
            'contain' => ['Issuers', 'Companies']
        ]);

        $this->set('grant', $grant);
        $this->set('_serialize', ['grant']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grant = $this->Grants->newEntity();
        if ($this->request->is('post')) {
            $grant = $this->Grants->patchEntity($grant, $this->request->getData());
            if ($this->Grants->save($grant)) {
                $this->Flash->success(__('The grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grant could not be saved. Please, try again.'));
        }
        $issuers = $this->Grants->Issuers->find('list', ['limit' => 200]);
        $companies = $this->Grants->Companies->find('list', ['limit' => 200]);
        $this->set(compact('grant', 'issuers', 'companies'));
        $this->set('_serialize', ['grant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grant = $this->Grants->get($id, [
            'contain' => ['Companies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grant = $this->Grants->patchEntity($grant, $this->request->getData());
            if ($this->Grants->save($grant)) {
                $this->Flash->success(__('The grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grant could not be saved. Please, try again.'));
        }
        $issuers = $this->Grants->Issuers->find('list', ['limit' => 200]);
        $companies = $this->Grants->Companies->find('list', ['limit' => 200]);
        $this->set(compact('grant', 'issuers', 'companies'));
        $this->set('_serialize', ['grant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grant = $this->Grants->get($id);
        if ($this->Grants->delete($grant)) {
            $this->Flash->success(__('The grant has been deleted.'));
        } else {
            $this->Flash->error(__('The grant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
