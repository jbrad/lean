<?php 
if( '' !== get_the_ID() ) {
	echo Standard_Breadcrumbs::get_breadcrumb_trail( get_the_ID() );
} // end if 