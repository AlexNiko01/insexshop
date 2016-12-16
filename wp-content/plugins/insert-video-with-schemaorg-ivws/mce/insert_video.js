(function() {
	tinymce.PluginManager.add('art_insert_yt', function( editor, url ) { 
		editor.addButton( 'art_insert_yt', { 
		icon: 'ivs', 
		type: 'button',
	    title: editor.getLang('art_insert_yt.ivs_title'), 
		image : url + '/img/Youtube3.png',
			onclick: function() {
				editor.windowManager.open( {
					title: editor.getLang('art_insert_yt.ivs_title'), 
					width:680,
					height:450,
					autoScroll: true,
					classes: 'myAwesomeClass-panel',
						body: [
							{
								type: 'label',
								text: editor.getLang('art_insert_yt.ivs_title_section_video'),
								style:'font-size: 16px;font-weight: bold;border-bottom: 1px solid #444;width : 550px;'
								
							},
							{
								type: 'textbox', 
								name: 'id',
								label: editor.getLang('art_insert_yt.ivs_add_video_id'),
								tooltip: editor.getLang('art_insert_yt.ivs_add_video_id_tooltip'),
								autofocus:true,
								value: 'k146VyYRN1M'
								
							},
							{
								type: 'textbox', 
								name: 'wvideo', 
								label: editor.getLang('art_insert_yt.ivs_add_video_width'), 
								tooltip: editor.getLang('art_insert_yt.ivs_add_video_width_tooltip'), 
								value: '640'
								
							},
							{
								type: 'textbox', 
								name: 'hvideo', 
								label: editor.getLang('art_insert_yt.ivs_add_video_height'),  
								tooltip: editor.getLang('art_insert_yt.ivs_add_video_height_tooltip'),
								value: '360' 
								
							},
							{
								type: 'listbox', 
								name: 'position',
								label: editor.getLang('art_insert_yt.ivs_add_video_align'),
								tooltip: editor.getLang('art_insert_yt.ivs_add_video_align_tooltip'),
								'values': [ 
									{text: editor.getLang('art_insert_yt.ivs_add_video_align_center'), value: 'center'}, 
									{text: editor.getLang('art_insert_yt.ivs_add_video_align_left'), value: 'left'},
									{text: editor.getLang('art_insert_yt.ivs_add_video_align_right'), value: 'right'}
									]
							},
							{
								type: 'label',
								text: editor.getLang('art_insert_yt.ivs_title_section_schema'),
								style:'font-size: 16px;font-weight: bold;border-bottom: 1px solid #444;'
								
							},
							{
								type: 'textbox', 
								name: 'urlvideo', 
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_url'), 
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_url_tooltip'),
								value: 'https://www.youtube.com/watch?v=HPwH0yS1c44'
							},
							{
								type: 'textbox', 
								name: 'namevideo', 
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_name'),
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_name_tooltip'),						
							},
							{
								type: 'textbox',
								name: 'desc',
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_desc'),
								multiline: true, 
								minWidth: 300,
								minHeight: 100,
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_desc_tooltip'),
							},
							{
								type: 'FormItem',
								text: editor.getLang('art_insert_yt.ivs_title_add_schema_duration_label'),
								columns:5,
								items: [
							
								{
									type: 'label',
									text: editor.getLang('art_insert_yt.ivs_title_add_schema_duration_label'),
									style:'',
									tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_duration_label_tooltip'),
								},
								{
									type: 'label',
									text: 'PT',
									style:'left: 171px !important;'
								},
								{
									type: 'textbox', 
									name: 'durationmin',
									text: 'PT',
									style:'left: 195px !important;width: 165px !important;',
									tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_duration_min'),								
								},
								{
									type: 'label',
									text: "M",
									style:''
								},
								{
									type: 'textbox', 
									name: 'durationsec',
									text: 'M',									
									style:'left: 421px !important;width: 190px !important;',
									tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_duration_sec'),									
								},
								]
							},
							{
								type: 'textbox',
								name: 'upld',
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_download'),
								classes: ' datepicker',
								style:'',
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_download_tooltip'),

							},
							{
								type: 'textbox', 
								name: 'tmburl',
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb'),
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb_tooltip'),
								style:'',
								value: 'https://i.ytimg.com/vi/Ogk1RAO-Z6w/maxresdefault.jpg'
							},
							{
								type: 'textbox', 
								name: 'thumbnailwidth', 
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb_width'), 
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb_width_tooltip'), 
								style:'',
								value: '1280'
							},
							{
								type: 'textbox', 
								name: 'thumbnailheight', 
								label: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb_height'),
								tooltip: editor.getLang('art_insert_yt.ivs_title_add_schema_thumb_height_tooltip'),
								style:'',
								value: '720' 
								
							},
							],
									onclick: function(e) {
									  jQuery('input[class*="datepicker"]').datepicker({
											dateFormat : 'yy-mm-dd',
											changeMonth: true,
											changeYear: true
										});
									 },
									onsubmit: function( e ) { 
										editor.insertContent( '[art_yt id="' + e.data.id + '" wvideo="' + e.data.wvideo + '" hvideo="' + e.data.hvideo + '" position="' + e.data.position + '" urlvideo="' + e.data.urlvideo + '" namevideo="' + e.data.namevideo + '" desc="' + e.data.desc + '" durationmin="' + e.data.durationmin + '" durationsec="' + e.data.durationsec + '" upld="' + e.data.upld + '" tmburl="' + e.data.tmburl + '" thumbnailwidth="' + e.data.thumbnailwidth + '" thumbnailheight="' + e.data.thumbnailheight + '"]');
										
									}
								});
							}
		});
       	});
})();