<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompaniesGrants Controller
 *
 * @property \App\Model\Table\CompaniesGrantsTable $CompaniesGrants
 *
 * @method \App\Model\Entity\CompaniesGrant[] paginate($object = null, array $settings = [])
 */
class CompaniesGrantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     * @param $await set the status await
     */
    public function index(int $await=1)
    {
        $this->paginate = [
            'sortWhitelist' => [
                'Companies.name', 'Grants.shortname', 'amount', 'contact',
                'LatestHistory.Histories__deadline', 'Statuses.name'
            ],
            'order' => [
                'LatestHistory.Histories__deadline' => 'DESC',
                'Statuses.await' => 'DESC',
                'Statuses.name'
            ]
        ];

        $companiesGrants = $this->paginate($this->CompaniesGrants->find('current')->where(['Statuses.await' => $await]));
        $this->set(compact('companiesGrants'));
        $this->set('_serialize', ['companiesGrants']);
    }

    /**
     * View method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companiesGrant = $this->CompaniesGrants->get($id, [
            'contain' => [
                'Companies',
                'Grants.Issuers',
                'Histories' => ['Statuses', 'Tags', 'Users']
            ]
        ]);
        $this->set('companiesGrant', $companiesGrant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companiesGrant = $this->CompaniesGrants->newEntity();
        if ($this->request->is('post')) {
            $companiesGrant = $this->CompaniesGrants->patchEntity($companiesGrant, $this->request->getData());
            if ($this->CompaniesGrants->save($companiesGrant)) {
                $this->Flash->success(__('The companies grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The companies grant could not be saved. Please, try again.'));
        }
        $companies = $this->CompaniesGrants->Companies->find('list', ['limit' => 200]);
        $grants = $this->CompaniesGrants->Grants->find('list', ['limit' => 200]);
        $this->set(compact('companiesGrant', 'companies', 'grants'));
        $this->set('_serialize', ['companiesGrant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companiesGrant = $this->CompaniesGrants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companiesGrant = $this->CompaniesGrants->patchEntity($companiesGrant, $this->request->getData());
            if ($this->CompaniesGrants->save($companiesGrant)) {
                $this->Flash->success(__('The companies grant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The companies grant could not be saved. Please, try again.'));
        }
        $companies = $this->CompaniesGrants->Companies->find('list', ['limit' => 200]);
        $grants = $this->CompaniesGrants->Grants->find('list', ['limit' => 200]);
        $this->set(compact('companiesGrant', 'companies', 'grants'));
        $this->set('_serialize', ['companiesGrant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Companies Grant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companiesGrant = $this->CompaniesGrants->get($id);
        if ($this->CompaniesGrants->delete($companiesGrant)) {
            $this->Flash->success(__('The companies grant has been deleted.'));
        } else {
            $this->Flash->error(__('The companies grant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
