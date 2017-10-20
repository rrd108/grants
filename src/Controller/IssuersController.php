<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Issuers Controller
 *
 * @property \App\Model\Table\IssuersTable $Issuers
 *
 * @method \App\Model\Entity\Issuer[] paginate($object = null, array $settings = [])
 */
class IssuersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $issuers = $this->paginate($this->Issuers);

        $this->set(compact('issuers'));
        $this->set('_serialize', ['issuers']);
    }

    /**
     * View method
     *
     * @param string|null $id Issuer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issuer = $this->Issuers->get($id, [
            'contain' => ['Grants']
        ]);

        $this->set('issuer', $issuer);
        $this->set('_serialize', ['issuer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issuer = $this->Issuers->newEntity();
        if ($this->request->is('post')) {
            $issuer = $this->Issuers->patchEntity($issuer, $this->request->getData());
            if ($this->Issuers->save($issuer)) {
                $this->Flash->success(__('The issuer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issuer could not be saved. Please, try again.'));
        }
        $this->set(compact('issuer'));
        $this->set('_serialize', ['issuer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Issuer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $issuer = $this->Issuers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issuer = $this->Issuers->patchEntity($issuer, $this->request->getData());
            if ($this->Issuers->save($issuer)) {
                $this->Flash->success(__('The issuer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issuer could not be saved. Please, try again.'));
        }
        $this->set(compact('issuer'));
        $this->set('_serialize', ['issuer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Issuer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issuer = $this->Issuers->get($id);
        if ($this->Issuers->delete($issuer)) {
            $this->Flash->success(__('The issuer has been deleted.'));
        } else {
            $this->Flash->error(__('The issuer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
