<?php

use yii\db\Migration;
use yii\db\Schema;

class m160621_074453_init extends Migration
{
    public function up()
    {
		$this->createTable('demo', [
            'id' => Schema::TYPE_PK,
            'name' => 'VARBINARY(255) NOT NULL',
			'phone' => 'VARBINARY(255) NOT NULL',
			'age' => Schema::TYPE_INTEGER,
            'content' => Schema::TYPE_TEXT,
        ]);
		
		$command = Yii::$app->db->createCommand('INSERT INTO demo (`name`,`phone`,`age`,`content`) VALUES (:name,:phone,:age,:content)');
		$securityKey = Yii::$app->params['decryptKey'];
		for ($i=0; $i<100000; $i++) {
			$command->bindValues([
				':name' => Yii::$app->getSecurity()->encryptByKey($this->getRandomName(),$securityKey),
				':phone' => Yii::$app->getSecurity()->encryptByKey($this->getRandomPhone(),$securityKey),
				':age'=> rand(18,80),
				':content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum volutpat magna, quis feugiat nulla faucibus vestibulum. Nullam id orci nec libero porttitor dignissim eget quis libero. In accumsan vulputate est, in ultricies lectus ultrices in. Cras et aliquet mauris. Aliquam maximus nibh ac mi vestibulum, et gravida leo rutrum. Donec ultrices justo placerat aliquet tristique. Maecenas vulputate non neque eu eleifend. Vestibulum eget pulvinar augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
			]);
			$command->execute();
		}
		
    }

	private function getRandomName()
	{
		$names = [
			'Aaron',
			'Abdul',
			'Abe',
			'Abel',
			'Abraham',
			'Abram',
			'Adalberto',
			'Adam',
			'Adan',
			'Adolfo',
			'Adolph',
			'Adrian',
			'Agustin',
			'Ahmad',
			'Ahmed',
			'Al',
			'Alan',
			'Albert',
			'Alberto',
			'Alden',
			'Aldo',
			'Alec',
			'Alejandro',
			'Alex',
			'Alexander',
			'Alexis',
			'Alfonso',
			'Alfonzo',
			'Alfred',
			'Dale',
			'Dallas',
			'Dalton',
			'Damian',
			'Damien',
			'Damion',
			'Damon',
			'Dan',
			'Dana',
			'Dane',
			'Danial',
			'Daniel',
			'Danilo',
			'Dannie',
			'Danny',
			'Dante',
			'Darell',
			'Daren',
			'Darin',
			'Dario',
			'Darius',
			'Darnell',
			'Daron',
			'Darrel',
			'Darrell',
			'Darren',
			'Darrick',
			'Darrin',
			'Darron',
			'Darryl',
			'Darwin',
			'Daryl',
			'Dave',
		];
		return $names[rand(0,count($names)-1)];
	}
	
	private function getRandomPhone()
	{
		return '+7 ('.rand(0,9).rand(0,9).rand(0,9)
			.') '.rand(0,9).rand(0,9).rand(0,9)
			.' '.rand(0,9).rand(0,9).' '.rand(0,9).rand(0,9);
	}
	
    public function down()
    {
        $this->dropTable('demo');
    }
}
