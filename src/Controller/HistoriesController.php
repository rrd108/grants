<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Histories Controller
 *
 * @property \App\Model\Table\HistoriesTable $Histories
 *
 * @method \App\Model\Entity\History[] paginate($object = null, array $settings = [])
 */
class HistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CompaniesGrants.Grants', 'CompaniesGrants.Companies', 'Statuses', 'Users']
        ];
        $histories = $this->paginate($this->Histories);

        $this->set(compact('histories'));
        $this->set('_serialize', ['histories']);
    }

    /**
     * View method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $history = $this->Histories->get($id, [
            'contain' => ['CompaniesGrants', 'Statuses', 'Users', 'Tags']
        ]);

        $this->set('history', $history);
        $this->set('_serialize', ['history']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $history = $this->Histories->newEntity();
        if ($this->request->is('post')) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($history->hasdeadline != 1){
                $history->deadline = null;
            }
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }
        $companiesGrants = $this->Histories->CompaniesGrants->find()
            ->contain(['Companies', 'Grants'])
            ->indexBy('id')
            ->map(function ($companyGrant) {
                return $companyGrant->company->name . ' - ' . $companyGrant->grant->shortname;
            });
        $statuses = $this->Histories->Statuses->find('list', ['limit' => 200])->order('name');
        $users = $this->Histories->Users->find('list', ['limit' => 200]);
        $tags = $this->Histories->Tags->find('list', ['limit' => 200]);
        $this->set(compact('history', 'companiesGrants', 'statuses', 'users', 'tags'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Edit method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $history = $this->Histories->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($history->hasdeadline != 1){
                $history->deadline = null;
            }
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }
        $companiesGrants = $this->Histories->CompaniesGrants->find('list', ['limit' => 200]);
        $statuses = $this->Histories->Statuses->find('list', ['limit' => 200]);
        $users = $this->Histories->Users->find('list', ['limit' => 200]);
        $tags = $this->Histories->Tags->find('list', ['limit' => 200]);
        $this->set(compact('history', 'companiesGrants', 'statuses', 'users', 'tags'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Delete method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $history = $this->Histories->get($id);
        if ($this->Histories->delete($history)) {
            $this->Flash->success(__('The history has been deleted.'));
        } else {
            $this->Flash->error(__('The history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
