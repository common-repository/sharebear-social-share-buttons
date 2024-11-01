<?php
	// Radio Images
	add_action('cmb2_render_radio_image', 'cmb2_radio_image_callback', 10, 5);
	function cmb2_radio_image_callback($field, $escaped_value, $object_id, $object_type, $field_type_object) {
	    echo $field_type_object->radio();
	}
	
	add_filter('cmb2_list_input_attributes', 'cmb2_radio_image_attributes', 10, 4);
	function cmb2_radio_image_attributes($args, $defaults, $field, $cmb) {
	    if ($field->args['type'] == 'radio_image' && isset($field->args['images'])) {
	        foreach ($field->args['images'] as $field_id => $image) {
	            if ($field_id == $args['value']) {
	                $image = trailingslashit($field->args['images_path']) . $image;
	                $args['label'] = '<img src="' . $image . '" alt="' . $args['value'] . '" title="' . $args['label'] . '" /> '.$args['label'].' ';
	            }
	        }
	    }
	    return $args;
	}

	add_action('admin_head', 'cmb2_radio_image');
	function cmb2_radio_image() {
	    ?>
	    <style>
	        .cmb-type-radio-image .cmb2-radio-list {
	            display: block;
	            clear: both;
	            overflow: hidden;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"] {
	            display: none;
	        }
	        .cmb-type-radio-image .cmb2-radio-list li {
	            display: inline-block;
	            margin-bottom: 0;
	            margin-right: 15px;
	            text-align: center;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"] + label {
	            display: block;
	            font-size: 12px;
	            opacity: .5;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"] + label img {
	            border: 2px solid transparent;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"] + label:hover {
	        	opacity: 1;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"]:checked + label img {
	            border-color: #ccc;
	            opacity: 1;
	        }
	        .cmb-type-radio-image .cmb2-radio-list input[type="radio"]:checked + label {
	            opacity: 1;
	        }
	        .cmb-type-radio-image .cmb2-radio-list li label img {
	            display: block;
	            margin-bottom: 5px;
	        }
	    </style>
	    <?php
	}