<?php
class Datinator
{
  /**
	* gets week start/end date either for passed in week $week
	* @param  $i
	* @return array();
	*/
	public function this_week($week) {
		$ts = $week;
		$start = strtotime( 'monday this week', $ts );
		$end = strtotime( 'monday this week +1 week', $ts );
		$end = strtotime( '-1 day', $end );
	
		$start_time = $start;
		$end_time = $end;
	
		return array(
			'start'			=>	date('Y-m-d', $start),
			'end'			=>	date('Y-m-d', $end),
			'start_time'	=>	$start_time,
			'end_time'		=>	$end_time
		);
	}

	/**
	* gets month start/end date either for passed in month $month
	* @param  $i
	* @return array();
	*/
	public function get_month($month) {
		$start_time = 'first day of ' . date( 'M Y', $month );
		$end_time = 'last day of ' . date( 'M Y', $month );

		return array(
			'start'			=>	date('Y-m-d', strtotime($start_time)),
			'end'			=>	date('Y-m-d', strtotime($end_time)),
			'start_time'	=>	strtotime( $start_time ),
			'end_time'		=>	strtotime( $end_time )
		);
	}

	/**
	* gets quarter start/end date either for current date or previous according to $i
	* i.e. $i = 0 => current quarter, $i = 1 => 1st full quarter, $i = n => n full quarter
	* @param  $i
	* @return array();
	*/
	public function get_quarter($i = 0) {
		$y = date('Y');
		$m = date('m');

		if( $i > 0 ) {
			for( $x = 0; $x < $i; $x++ ) {
				if( $m <= 3 ) { $y--; }
					$diff = $m % 3;
					$m = ( $diff > 0 ) ? $m - $diff : $m - 3;
				if( $m == 0 ) { $m = 12; }
			}
		}

		switch( $m ) {
			case $m >= 1 && $m <= 3:
				$start = $y . '-01-01 00:00:01';
				$end = $y . '-03-31 00:00:00';
			break;
			case $m >= 4 && $m <= 6:
				$start = $y . '-04-01 00:00:01';
				$end = $y . '-06-30 00:00:00';
			break;
			case $m >= 7 && $m <= 9:
				$start = $y . '-07-01 00:00:01';
				$end = $y . '-09-30 00:00:00';
			break;
			case $m >= 10 && $m <= 12:
				$start = $y . '-10-01 00:00:01';
				$end = $y . '-12-31 00:00:00';
			break;
		}

		return array(
			'start'			=>	$start,
			'end'			=>	$end,
			'start_time'	=>	strtotime( $start ),
			'end_time'		=>	strtotime( $end )
		);
	}

	/**
	* gets year start/end date either for passed in year
	* @param  $i
	* @return array();
	*/
	public function get_year($year) {
		$start_time = 'first day of January ' . date( 'Y', strtotime($year) );
		$end_time = 'last day of December ' . date( 'Y', strtotime($year) );
	
		return array(
			'start'			=>	date('Y-m-d', strtotime($start_time)),
			'end'			=>	date('Y-m-d', strtotime($end_time)),
			'start_time'	=>	strtotime( $start_time ),
			'end_time'		=>	strtotime( $end_time )
		);
	}
}
?>
