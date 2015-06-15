(function(){
	tinymce.PluginManager.add('ctsc_shortcodes', function(editor, url){
		editor.addButton('ctsc_shortcodes_button', {
			title: 'CPO Shortcodes',
			type: 'menubutton',
			icon: 'icon ctsc-shortcodes-icon',
			menu: [
				{
					text: 'Design Elements',
					menu: [
						{ text: 'Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'button background="gray" gradient="black" color="white" url="http://google.com" size="normal" position="none"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'button]'); } },
						{ text: 'Focus Box', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'focus color="light" background="lightgrey" gradient="darkgray" style="normal"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'focus]'); } },
						{ text: 'Message', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'message type="info"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'message]'); } },
						{ text: 'Progress', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'progress color="red" icon="ok" size="normal" value="50" title="Progress Bar"]'); } },
						{ text: 'Inline Feature', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'feature icon="flag" style="horizontal" title="Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'feature]'); } },
						{ text: 'Team Member', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'team image="" name="Member Name" title="Job Title" web="" facebook="" twitter="" gplus=""]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'team]'); } },
						{ text: 'Testimonial', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'testimonial image="" name="Testimonial Name" title="Job Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'testimonial]'); } },
						{ text: 'Counter', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'counter icon="ok" title="Counter Title" number="999"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'counter]'); } },
						{ text: 'Definition', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'definition title="Definition Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'definition]'); } },
						/*{
							text: 'Button (New)',
							onclick: function(){ 
								editor.windowManager.open({
									title: 'Add New Button',
									body: ctsc_generator_button,
									onsubmit: function(e){
										editor.selection.setContent('[button url="' + e.data.url + '" color="' + e.data.color + '" background="' + e.data.background + '" gradient="' + e.data.gradient + '" size="' + e.data.size + '" position="' + e.data.position + '" icon="' + e.data.icon + '" target="' + e.data.target + '" rel="' + e.data.rel + '"]' + e.data.text + '[/button]');
									}
								});
							}
						},*/
					]
				},
				{
					text: 'Interactive',
					menu: [		
						{ text: 'Accordion', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'accordion title="Title" state="open"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'accordion]'); } },
						{ text: 'Tabbed Content', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'tabs][' + ctsc_vars.prefix + 'tab title="Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'tab][/' + ctsc_vars.prefix + 'tabs]'); } },
						{ text: 'Slideshow', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'slideshow][' + ctsc_vars.prefix + 'slide]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'slide][/' + ctsc_vars.prefix + 'slideshow]'); } },
						{ text: 'Map', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'map latitude="" longitude="" color="" height="400"]'); } },
						{ text: 'Pricing Table', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'pricing title="Product" subtitle="Subtitle" description="One Time Fee" price="99" before="$" after="" color="gray" type="highlight"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'pricing]'); } },
						{ text: 'Mailchimp Optin Form', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'optin url="MAILCHIMPURL" captcha="MAILCHIMPCAPTCHA" email="Your Email" firstname="First Name" lastname="Last Name" submit="Subscribe" style="vertical"]'); } },
					]
				},
				{
					text: 'Content',
					menu: [			
						{ text: 'Dropcap', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'dropcap style="square"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'dropcap]'); } },
						{ text: 'Leading', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'leading]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'leading]'); } },
						{ text: 'List', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'list icon="ok" style="round"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'list]'); } },
						{ text: 'Post List', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'posts type="post" number="5" columns="1"]'); } },
					]
				},
				/*{
					text: 'Social',
					menu: [			
						{ text: 'Like Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'fb_like url="" style="standard" font="arial" action="like" width="450" height="30" position="none"]'); } },
						{ text: 'Tweet Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'tweet url="" style="none" font="arial" action="like" width="450" height="30" position="none"]'); } },
						{ text: '+1 Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'gplus counter="" style="" width="450" height="30" position="none"]'); } },
					]
				},*/
				{
					text: 'Layout',
					menu: [			
						{ text: 'Section', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'section title="Section Title" subtitle="Section Subtitle" background="#f3f3f3" gradient="#eeeeee"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'section]'); } },
						{ text: 'Two Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'column_half]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_half][' + ctsc_vars.prefix + 'column_half_last]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_half_last]'); } },
						{ text: 'Three Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'column_third]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_third][' + ctsc_vars.prefix + 'column_third]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_third][' + ctsc_vars.prefix + 'column_third_last]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_third_last]'); } },
						{ text: 'Four Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fourth][' + ctsc_vars.prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fourth][' + ctsc_vars.prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fourth][' + ctsc_vars.prefix + 'column_fourth_last]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fourth_last]'); } },
						{ text: 'Five Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fifth][' + ctsc_vars.prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fifth][' + ctsc_vars.prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fifth][' + ctsc_vars.prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fifth][' + ctsc_vars.prefix + 'column_fifth_last]<br><br>Column<br><br>[/' + ctsc_vars.prefix + 'column_fifth_last]'); } },
						{ text: 'Separator', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'separator type="top"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'separator]'); } },
						{ text: 'Animation Effect', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'animation animation="slideup" delay="1000"]' + editor.selection.getContent() + '[/' + ctsc_vars.prefix + 'animation]'); } },
						{ text: 'Spacer', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'spacer height="30"]'); } },
						{ text: 'Clearing DIV', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.prefix + 'clear]'); } },
					]
				}

			]
		});
	});
})();


var ctsc_generator_button = [
	{ type:'textbox', name:'text', label:'Button Text', value:'Read More'}, 
	{ type:'textbox', name:'description', label:'Description Text', value:'Click Here'}, 
	{ type:'textbox', name:'url', label:'Target URL', value:'http://www.cpothemes.com'}, 
	{ type:'textbox', name:'background', label:'Background Color', value:'#666666'}, 
	{ type:'textbox', name:'gradient', label:'Gradient Color', value:'#444444'}, 
	{ type:'textbox', name:'color', label:'Text Color', value:'#FFFFFF'}, 
	{ type:'listbox', name:'size', label:'Button Size', values:[
		{text: 'Normal', value: 'normal'},
		{text: 'Small', value: 'small'},
		{text: 'Medium', value: 'medium'},
		{text: 'Large', value: 'large'},
		{text: 'Huge', value: 'huge'},
	]}, 
	{ type:'listbox', name:'position', label:'Button Position', values:[
		{text: 'None', value: 'none'},
		{text: 'To The Left', value: 'left'},
		{text: 'Centered', value: 'center'},
		{text: 'To The Right', value: 'right'},
	]}, 
	{ type:'textbox', name:'target', label:'Target Attribute', value:''}, 
	{ type:'textbox', name:'rel', label:'Rel Attribute', value:''}, 
	{ type:'textbox', name:'icon', label:'Button Icon', value:''}, 
 
];