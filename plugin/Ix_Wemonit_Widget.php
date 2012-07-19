<?php

class Ix_Wemonit_Widget extends WP_Widget {

    protected $ix_wemonit;

    public function __construct() {
	$this->ix_wemonit = $GLOBALS[ 'ix_wemonit' ];
	$this->services = $this->ix_wemonit->getServices();
	parent::__construct( 'ix_wemonit_widget', 'IX WeMonit' );
    }

    public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
	    $title = $instance[ 'title' ];
	} else {
	    $title = __( 'New title' );
	}
	?>
	<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
	    <label for="<?php echo $this->get_field_id( 'service_id' ); ?>"><?php _e( 'WeMonit Service', 'ix_wemonit' ); ?></label>
	    <select class="widefat" id="<?php echo $this->get_field_id( 'service_id' ); ?>" name="<?php echo $this->get_field_name( 'service_id' ); ?>">
		<?php if ( !empty( $this->services ) ): ?>
		    <?php foreach ( $this->services as $key => $val ): ?>
			<option value="<?php echo $val[ 'service_id' ]; ?>"<?php echo $instance[ 'service_id' ] == $val[ 'service_id' ] ? ' selected="selected"' : ''; ?>><?php echo $val[ 'name' ]; ?></option>
		    <?php endforeach; ?>
		<?php else: ?>
	    	<option value="0"><?php _e( 'No WeMonit Services found', 'ix_wemonit' ); ?></option>
		<?php endif; ?>
	    </select>
	</p>
	<p>
	    <input type="hidden" name="<?php echo $this->get_field_name( 'show_age' ); ?>" value="0" />
	    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_age' ); ?>" name="<?php echo $this->get_field_name( 'show_age' ); ?>"<?php echo $instance[ 'show_age' ] ? ' checked="checked"' : ''; ?> />  
	    <label for="<?php echo $this->get_field_id( 'show_age' ); ?>"><?php _e( 'Show Age', 'ix_wemonit' ); ?></label>
	</p>
	<p>
	    <input type="hidden" name="<?php echo $this->get_field_name( 'show_current_latency' ); ?>" value="0" />
	    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_current_latency' ); ?>" name="<?php echo $this->get_field_name( 'show_current_latency' ); ?>"<?php echo $instance[ 'show_current_latency' ] ? ' checked="checked"' : ''; ?> />  
	    <label for="<?php echo $this->get_field_id( 'show_current_latency' ); ?>"><?php _e( 'Show Current Latency', 'ix_wemonit' ); ?></label>
	</p>
	<hr />
	<fieldset>
	    <legend><strong>IP4</strong></legend>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip4_show_downtime_count' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip4_show_downtime_count' ); ?>" name="<?php echo $this->get_field_name( 'ip4_show_downtime_count' ); ?>"<?php echo $instance[ 'ip4_show_downtime_count' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip4_show_downtime_count' ); ?>"><?php _e( 'Show Downtime Count', 'ix_wemonit' ); ?></label>
	    </p>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip4_show_downtime_percent' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip4_show_downtime_percent' ); ?>" name="<?php echo $this->get_field_name( 'ip4_show_downtime_percent' ); ?>"<?php echo $instance[ 'ip4_show_downtime_percent' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip4_show_downtime_percent' ); ?>"><?php _e( 'Show Downtime Percent', 'ix_wemonit' ); ?></label>
	    </p>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip4_show_uptime_percent' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip4_show_uptime_percent' ); ?>" name="<?php echo $this->get_field_name( 'ip4_show_uptime_percent' ); ?>"<?php echo $instance[ 'ip4_show_uptime_percent' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip4_show_uptime_percent' ); ?>"><?php _e( 'Show Uptime Percent', 'ix_wemonit' ); ?></label>
	    </p>
	</fieldset>
	<hr />
	<fieldset>
	    <legend><strong>IP6</strong></legend>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip6_show_downtime_count' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip6_show_downtime_count' ); ?>" name="<?php echo $this->get_field_name( 'ip6_show_downtime_count' ); ?>"<?php echo $instance[ 'ip6_show_downtime_count' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip6_show_downtime_count' ); ?>"><?php _e( 'Show Downtime Count', 'ix_wemonit' ); ?></label>
	    </p>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip6_show_downtime_percent' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip6_show_downtime_percent' ); ?>" name="<?php echo $this->get_field_name( 'ip6_show_downtime_percent' ); ?>"<?php echo $instance[ 'ip6_show_downtime_percent' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip6_show_downtime_percent' ); ?>"><?php _e( 'Show Downtime Percent', 'ix_wemonit' ); ?></label>
	    </p>
	    <p>
		<input type="hidden" name="<?php echo $this->get_field_name( 'ip6_show_uptime_percent' ); ?>" value="0" />
		<input type="checkbox" id="<?php echo $this->get_field_id( 'ip6_show_uptime_percent' ); ?>" name="<?php echo $this->get_field_name( 'ip6_show_uptime_percent' ); ?>"<?php echo $instance[ 'ip6_show_uptime_percent' ] ? ' checked="checked"' : ''; ?> />
		<label for="<?php echo $this->get_field_id( 'ip6_show_uptime_percent' ); ?>"><?php _e( 'Show Uptime Percent', 'ix_wemonit' ); ?></label>
	    </p>
	</fieldset>
	<?php
    }

    public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	$instance[ 'service_id' ] = ( int ) $new_instance[ 'service_id' ];
	$instance[ 'show_age' ] = ( bool ) $new_instance[ 'show_age' ];
	$instance[ 'show_current_latency' ] = ( bool ) $new_instance[ 'show_current_latency' ];

	$instance[ 'ip4_show_downtime_count' ] = ( bool ) $new_instance[ 'ip4_show_downtime_count' ];
	$instance[ 'ip4_show_downtime_percent' ] = ( bool ) $new_instance[ 'ip4_show_downtime_percent' ];
	$instance[ 'ip4_show_uptime_percent' ] = ( bool ) $new_instance[ 'ip4_show_uptime_percent' ];

	$instance[ 'ip6_show_downtime_count' ] = ( bool ) $new_instance[ 'ip6_show_downtime_count' ];
	$instance[ 'ip6_show_downtime_percent' ] = ( bool ) $new_instance[ 'ip6_show_downtime_percent' ];
	$instance[ 'ip6_show_uptime_percent' ] = ( bool ) $new_instance[ 'ip6_show_uptime_percent' ];

	return $instance;
    }

    public function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );

	echo $before_widget;
	if ( !empty( $title ) )
	    echo $before_title . $title . $after_title;
	$service = $this->ix_wemonit->getService( $instance[ 'service_id' ] );
	if ( $service ) {
	    echo '<p><strong>' . $service[ 'name' ] . '</strong></p>';

	    if ( $instance[ 'show_age' ] )
		echo '<p>' . __( 'Timespan', 'ix_wemonit' ) . ': ' . sprintf( "%d " . __( 'Days', 'ix_wemonit' ) . " %02d:%02d:%02d " . __( 'Hours', 'ix_wemonit' ), $service[ 'stats' ][ 'age' ] / 60 / 60 / 24, ($service[ 'stats' ][ 'age' ] / 60 / 60) % 24, ($service[ 'stats' ][ 'age' ] / 60) % 60, $service[ 'stats' ][ 'age' ] % 60 ) . '</p>';
	    if ( $instance[ 'show_current_latency' ] )
		echo '<p>' . __( 'Current Latency', 'ix_wemonit' ) . ': ' .  ix_wemonit_getCurrentLatency( $instance[ 'service_id' ]).'ms' ;

	    if ( $instance[ 'ip4_show_downtime_count' ] )
		echo '<p>' . __( 'IP4 Downtime Count', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'downtime4' ] . ' ' . __( 'times', 'ix_wemonit' ) . '</p>';
	    if ( $instance[ 'ip4_show_downtime_percent' ] )
		echo '<p>' . __( 'IP4 Downtime', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'downtimePercent4' ] . '%</p>';
	    if ( $instance[ 'ip4_show_uptime_percent' ] )
		echo '<p>' . __( 'IP4 Uptime', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'uptimePercent4' ] . '%</p>';

	    if ( $instance[ 'ip6_show_downtime_count' ] )
		echo '<p>' . __( 'IP6 Downtime Count', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'downtime6' ] . ' ' . __( 'times', 'ix_wemonit' ) . '</p>';
	    if ( $instance[ 'ip6_show_downtime_percent' ] )
		echo '<p>' . __( 'IP6 Downtime', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'downtimePercent6' ] . '%</p>';
	    if ( $instance[ 'ip6_show_uptime_percent' ] )
		echo '<p>' . __( 'IP6 Uptime', 'ix_wemonit' ) . ': ' . $service[ 'stats' ][ 'uptimePercent6' ] . '%</p>';
	}else {
	    echo '<p>' . __( 'WeMonit service not found', 'ix_wemonit' );
	}

	echo $after_widget;
    }

}