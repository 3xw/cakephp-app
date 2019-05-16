<?
return [
	'Queue' => [
		/* Required config keys */

		// seconds to sleep() when no executable job is found
		'sleeptime' => 2,

		// probability in percent of a old job cleanup happening
		'gcprob' => 10,

		// time (in seconds) after which a job is requeued if the worker doesn't report back
		'defaultworkertimeout' => 1800,

		// number of retries if a job fails or times out.
		'defaultworkerretries' => 3,

		// seconds of running time after which the worker will terminate (0 = unlimited)
		'workermaxruntime' => 240,

		// minimum time (in seconds) which a task remains in the database before being cleaned up.
		'cleanuptimeout' => ( 7 * 60 * 60 * 24), // 7 jours

		/* Optional config keys */

		// set to true for multi server setup, this will affect web backend possibilities to kill/end workers
		'multiserver' => false,

		// set this to a limit that can work with your memory limits and alike, 0 => no limit
		'maxworkers' => 3,

		// instruct a Workerprocess quit when there are no more tasks for it to execute (true = exit, false = keep running)
		'exitwhennothingtodo' => true,

		// seconds of running time after which the PHP process will terminate, null uses workermaxruntime * 100
		'workertimeout' => null,

		// false for DB, or deprecated string pid file path directory (by default goes to the app/tmp/queue folder)
		'pidfilepath' => false, // Deprecated: TMP . 'queue' . DS,

		// determine whether logging is enabled
		'log' => true,

		// set default Mailer class
		'mailerClass' => 'Cake\Mailer\Email',

		// set default datasource connection
		'connection' => null,

		// enable Search. requires friendsofcake/search
		'isSearchEnabled' => true,

		// enable Search. requires frontend assets
		'isStatisticEnabled' => false,
	],
];
