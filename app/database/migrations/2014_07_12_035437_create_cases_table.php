<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cases', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('caseNumber');
			$table->integer('abusedChild_id')->unsigned();
			$table->integer('center_id')->unsigned();
			$table->integer('worker_id')->unsigned();
			$table->text('note')->nullable();
			$table->date('caseOpened');
                        $table->date('caseClosed')->nullable();
			$table->integer('county_id')->unsigned();
			$table->boolean('custodyIssues')->nullable();
			$table->boolean('IOReport')->nullable();  // ?
			$table->boolean('domesticViolence')->nullable();
			$table->boolean('prosecution')->nullable();
			$table->string('reporter')->nullable();
			$table->date('abuseDate')->nullable();
			$table->string('abuseLocation')->nullable();
			$table->string('referralReason')->nullable();
			$table->enum('DHRDetermination', array('indicated','not indicated','unknown'))->defaault('unknown');
			$table->boolean('forensicEvaluation')->default(false);
			$table->enum('status', array('open','closed'))->default('open');
			$table->text('chargesFiled')->nullable();
			$table->string('agencyReportedTo')->nullable();
			$table->text('talkedToChild')->nullable();
			$table->date('reportedDate')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cases');
	}

}
