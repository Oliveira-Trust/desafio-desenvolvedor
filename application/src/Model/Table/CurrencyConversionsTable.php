<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CurrencyConversions Model
 *
 * @method \App\Model\Entity\CurrencyConversion newEmptyEntity()
 * @method \App\Model\Entity\CurrencyConversion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CurrencyConversion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CurrencyConversion get($primaryKey, $options = [])
 * @method \App\Model\Entity\CurrencyConversion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CurrencyConversion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CurrencyConversion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CurrencyConversion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CurrencyConversion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CurrencyConversion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrencyConversion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrencyConversion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CurrencyConversion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CurrencyConversionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('currency_conversions');
        $this->setDisplayField('origin_currency');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('origin_currency')
            ->maxLength('origin_currency', 255)
            ->requirePresence('origin_currency', 'create')
            ->notEmptyString('origin_currency');

        $validator
            ->scalar('destination_currency')
            ->maxLength('destination_currency', 255)
            ->requirePresence('destination_currency', 'create')
            ->notEmptyString('destination_currency');

        $validator
            ->numeric('value_to_convert')
            ->requirePresence('value_to_convert', 'create')
            ->notEmptyString('value_to_convert');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 255)
            ->requirePresence('payment_method', 'create')
            ->notEmptyString('payment_method');

        $validator
            ->numeric('destination_currency_conversion_value')
            ->requirePresence('destination_currency_conversion_value', 'create')
            ->notEmptyString('destination_currency_conversion_value');

        $validator
            ->numeric('destination_currency_purchased_value')
            ->requirePresence('destination_currency_purchased_value', 'create')
            ->notEmptyString('destination_currency_purchased_value');

        $validator
            ->numeric('payment_tax')
            ->requirePresence('payment_tax', 'create')
            ->notEmptyString('payment_tax');

        $validator
            ->numeric('conversion_tax')
            ->requirePresence('conversion_tax', 'create')
            ->notEmptyString('conversion_tax');

        $validator
            ->numeric('conversion_value_without_tax')
            ->requirePresence('conversion_value_without_tax', 'create')
            ->notEmptyString('conversion_value_without_tax');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
