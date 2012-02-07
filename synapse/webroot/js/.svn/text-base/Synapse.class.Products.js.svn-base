


Synapse.NewProdDialog = function(){
	return {
        init : function() {
		
//----------------------------------FILES FORM---------------------------------------		
		
		
		var uploader = new Ext.ux.SwfUploadPanel({
			width: 650,
			height: 175,
			border: false,	
			upload_url: 'http://' + host + '/attachments/upload/',
			flash_url: 'http://' + host + '/js/ext-2.2/plugins/Ext.ux.SwfUploadPanel/swfupload_f9.swf',
			single_file_select: true,						 
			confirm_delete: false,
			remove_completed: true,
			listeners: {
				fileUploadCancelled: function(panel, file, code, b, c, d) {		
					Ext.MessageBox.alert('Message', code);
				},
				queueUploadComplete: function() {
					if (Ext.isGecko) {
						console.log("Files Finished");
					} else {
						alert("Files Finished");
					}				
				}	
			}
		});
		
		uploader.on('fileUploadComplete', function(panel, file, response) {
			Ext.Ajax.request({
				url: 'http://' + host + '/attachments/assignToProduct/',
				method: 'POST',
				params: {
					'product_id': product_id,
					'data[Attachment][attachment_name]': file.name			
				},
				success:function() {
					Ext.getCmp('attachmentsDV').store.load({
						params:{'product_id':product_id}
					});
				},
				failure: function() {}
			});
		});
		
		primarythumb = 0;

  
		var attachmentsPanel = new Ext.Panel({
			bodyStyle:'padding:0px;',
	        id:'attachmentsView',
			frame:false,
			border: true,
			x: -1, y: 175,
	        width:650, height:267,
	        collapsible:false,
			autoScroll: true,
	        layout:'absolute',
			items: new Ext.DataView({
						id: 'attachmentsDV',
			            store: new Ext.data.JsonStore({
					        url: 'http://' + host + '/attachments/getProductAttachments/',
					        root: 'attachments',
					        fields: ['id', 'attachment_id', 'attachment_name', 'attachment_category_id', 'extension'],
							listeners: {
								load: function(store, r, o) {
									Ext.getCmp('attachmentsDV').select(Ext.getCmp('attachmentsDV').lastselected);
									Ext.getCmp('attachmentsDV').updateEnabled();
								}			
							}
					    }),
			            tpl: new Ext.XTemplate(
							'<tpl for=".">',
					            '<div class="thumb-wrap" id="{id}">',
							    '<div class="thumb"><img src="{src}" title="{attachment_name}"></div>',
							    "<span class='prod-attach-file'>{shortName}</span><span class='prod-attach-cats'>{cat_name}</span></div>",
					        '</tpl>',
					        '<div class="x-clear"></div>'
						),
			            multiSelect: true,
			            overClass:'x-view-over',
						itemSelector:'div.thumb-wrap',
						deferEmptyText: false,
						width: 632,
						height: 250,
						style: 'background-color: transparent; margin:0px;',
						lastselected: 0,
						updateEnabled: function(){
							var recs = this.getSelectedRecords();
							var cat_id = recs[0].data.attachment_category_id;								
							
							Ext.getCmp('assigncatbtn').enable();
							Ext.getCmp('removebtn').enable();
							Ext.getCmp('prodcatbox').enable();
							
							if (cat_id == 1)
								Ext.getCmp('primarypicbtn').enable();
							else
								Ext.getCmp('primarypicbtn').disable();
						},			
					    prepareData: function(data){
			                data.shortName = Ext.util.Format.ellipsis(data.attachment_name, 15);
							switch (data.attachment_category_id) {
								case "0": {data.cat_name = "<span style='color:#FF0000;'>Unassigned</span>"; break;}
								case "1": {data.cat_name = "Image"; break;}
								case "2": {data.cat_name = "PI Sheet"; break;}
								case "3": {data.cat_name = "Spec. Sheet"; break;}
								case "4": {data.cat_name = "Quote"; break;}
								case "5": {data.cat_name = "Misc. Document"; break;}
							}
							Ext.Ajax.request({
								url: 'http://' + host + '/products/getPrimaryThumbnail/',
								params: {'product_id':product_id},
								success: function(result, request) {
									primarythumb = result.responseText;
									if (data.attachment_id == result.responseText)
										data.cat_name = "<span style='color:#4585dc;'>Primary Image</span>";
								},
								failure: function() {}
							});
							switch (data.extension.toUpperCase()) {
								case "XLS": 
								case "UNKNOWN": 
								case "ZIP":
								case "PDF":
								case "TXT":
								case "DOC":
								case "DOCX":
									data.src = wwwroot + 'img/filetype_icons/' + data.extension.toUpperCase() + '.png';
									break;	
								case "JPG":
								case "JPEG":
								case "GIF":
								case "PNG": 
									data.src = wwwroot + 'attachments/products/' + product_id + '/thumbs/s_' + data.attachment_name; 
									break;
								default: 
									data.src = wwwroot + 'img/filetype_icons/default.png'; 
									break;
							}
							Ext.getCmp('attachmentsDV').select(this.lastselected);
			                return data;
			            },
						listeners: {
							containerclick: function(dv, e){
								Ext.getCmp('assigncatbtn').disable();
								Ext.getCmp('removebtn').disable();
								Ext.getCmp('prodcatbox').disable();
								Ext.getCmp('primarypicbtn').disable();
							},
							click: function(dv, indexnum, elnode, e) {
								this.lastselected = indexnum;
								this.updateEnabled();
								
								var recs = this.getSelectedRecords();
								var cat_id = recs[0].data.attachment_category_id;
																
								if (cat_id == 0) {	
									Ext.getCmp('prodcatbox').setValue(cat_id);				
									Ext.getCmp('prodcatbox').getEl().highlight("b6ff9d", {
									    attr: "background-color",
									    endColor: "ffffff",
									    easing: 'easeIn',
									    duration: 2.5
									});
								}
								else {
									Ext.getCmp('prodcatbox').setValue(cat_id);
								}
							}
						}
			        }),
			tbar: new Ext.Toolbar({
					width: 650,
				    items:[{
						xtype: 'tbbutton',
						text: 'Remove File',
						iconCls:'remove',
						disabled: true,
						id: 'removebtn',
						listeners: {
							click: function(btn, e) {
								var recs = Ext.getCmp('attachmentsDV').getSelectedRecords();
								waitBox('Deleting...', 'Please wait', 'Deleting File from Product...');
								Ext.Ajax.request({
									url: 'http://' + host + '/attachments/deleteProductAttachment/' + recs[0].data.attachment_id,
									success: function() {
										Ext.MessageBox.hide();
										Ext.getCmp('attachmentsDV').store.load({
											params:{'product_id':product_id}
										});
									},
									failure: function() {}
								});
							}
						}
					},'-',{
						xtype: 'tbbutton',
						id: 'primarypicbtn',
						text: 'Assign as Primary Picture',
						iconCls: 'save',
						disabled: true,
						listeners: {
							click: function(btn, e) {
								var recs = Ext.getCmp('attachmentsDV').getSelectedRecords();
								waitBox('Assigning...', 'Please wait', 'Assigning Primary Picture');
								Ext.Ajax.request({
									url: 'http://' + host + '/attachments/assignPrimaryThumbnail/' + product_id + '/' + recs[0].data.attachment_id,
									success: function() {
										Ext.MessageBox.hide();
										Ext.getCmp('attachmentsDV').store.load({
											params:{'product_id': product_id}
										});
									},
									failure: function() {}
								}); 
							}
						}
					},'-',{
						xtype: 'tbbutton',
						id: 'assigncatbtn',
						text: 'Assign Category',
						iconCls: 'option',
						disabled: true,
						listeners: {
							click: function(btn, e) {
								var recs = Ext.getCmp('attachmentsDV').getSelectedRecords();
								waitBox('Assigning...', 'Please wait', 'Assigning Category to Product...');
								Ext.Ajax.request({
									url: 'http://' + host + '/attachments/assignAttachmentCategory/' + recs[0].data.attachment_id + '/' + Ext.getCmp('prodcatbox').getValue(),
									success: function() {
										Ext.MessageBox.hide();
										Ext.getCmp('prodcatbox').reset();
										Ext.getCmp('attachmentsDV').store.load({
											params:{'product_id': product_id}
										});
									},
									failure: function() {}
								}); 
							}
						}
					},'-',{
						xtype: 'combo',
						id: 'prodcatbox',
						store: [['0', 'Unassigned'], ['1', 'Product Image'], ['2', 'Product Information Sheet'], 
				            ['3', 'Specification Sheet'], ['4', 'Quote'], ['5', 'Misc. Document']],
						emptyText: 'Choose File Category ...',
				        width: 226,
						height: 22,
						mode: 'local',
						lazyInit: false,
						//forceSelection: true,
						editable: false,
						typeAhead: false,
						style: 'background: #fff;',
						disabled: true,
						listeners: {
							focus: function(field) {
								field.clearValue();
							}			
						}
					}]
				})
	    });
		
	 	var prodAttachmentsForm = new Ext.FormPanel({
			border: false,
			items: [{
				xtype: 'panel',
				layout: 'absolute',
				width: 650,
				height: 525,
				border: false,	
				items: [uploader, attachmentsPanel]
			}]						
		});	


//----------------------------------PRICES FORM---------------------------------------

		
		var priceCM = new Ext.grid.ColumnModel([
			{header: "Vendor", dataIndex: 'vendor_name', width: 350},
			{header: "Current Price", dataIndex: 'current_price', width: 100},
			{header: "Effective Date", dataIndex: 'effective_date', width: 100},
			{header: "Last Pricing", dataIndex: 'last_pricing', width: 100},
	    ]);
	
	
	    var priceDS = new Ext.data.Store({	
	        proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/prices/ListPricesGrid'}),  //note that I used ' + host + ' in the url
	        reader: new Ext.data.JsonReader({
	        root: 'prices',
			fields: [
				{name: 'id'},
				{name: 'vendor_name'},
				{name: 'current_price'},
				{name: 'effective_date'},
				{name: 'last_pricing'}
			]
			})
	    });		
		
	 	var prodPricesForm = new Ext.FormPanel({
			labelAlign: 'top',
			border: false,
        	items: [{
				x: -1, y: -1,
			    xtype: 'grid',
				cm: priceCM,
				ds: priceDS,
				stripeRows: true,
				height: 500,
				width: 650,
				layout:'fit',
				anchor: '100%',
				border: false
			}]
		});
		
		

//----------------------------------BASE FORM & FUNCTIONS-------------------------------------			
	

		var cardNav = function(incr, direction){
			var l = Ext.getCmp('card-layout-panel').getLayout();
			var i = l.activeItem.id.split('card-')[1];


			switch (i) {
				case "0": {
					//CHECK FOR PRODUCT NAME
					Ext.getCmp('prodBasicForm').form.submit({
						url: 'http://' + host + '/products/addNewProduct',
						success: function(form, action) {
							product_id = action.result.product_id;
						},
						failure: function() {
							Ext.MessageBox.alert('Message', 'Save failed!');  //********************DO BETTER HERE****************
						}
					});
					addNewProdWin.setTitle('Enter Specifications for Product');
					break;
				}
				
				case "1": {
					addNewProdWin.setTitle('Assign Categories and Tags to Product');
					break;
				}
			}
			
			var next = parseInt(i) + incr;
			l.setActiveItem(next);
			var cp = Ext.getCmp('card-layout-panel');
			cp.doLayout();
			Ext.getCmp('card-prev').setDisabled(next==0);
			Ext.getCmp('card-next').setDisabled(next==4);
		};
		
		
		
/***********ADD NEW PRODUCT WINDOW************/	

		var addNewProdWin = new Ext.Window({
			title: 'Add new product wizard',        
			layout:'fit',
		//	cls: 'menuheader',
	        width:650,
	        height:525,
			modal: true,
			closable: true,
			closeAction:'hide',   
	        resizable: false,
	        border: false,
	
/***********CARD LAYOUT**********/
	       	items: [{
				id:'card-layout-panel',
			    layout:'card',
				activeItem: 0,
				border:false,
				deferredRender: true,
				frame: false,
				defaults: {border:false},
				bbar: new Ext.Toolbar({
					items:[{
						xtype: 'label',
						html: "<span style='font-size: 12px; text-align: left; width: 400px; color: #666'>&nbsp;&nbsp;Text to guide you through the wizard...</span>"
					}, '->', {
						id: 'card-prev',
						text: '&laquo; Previous', 
						handler: cardNav.createDelegate(this, [-1], 'prev')
					},{
						id: 'card-next',
						text: 'Next &raquo;', 
						handler: cardNav.createDelegate(this, [1], 'next')
					}]
				}),
				items: [{					
/*******************BASIC INFO FORM******************/
					id: 'card-0',
					autoHeight: true,
					items: [{
						id: 'prodBasicForm',
						xtype: 'form',
						bodyStyle:"padding:6px 10px 10px 10px",
						labelAlign: 'left',
						anchor: '100%',
						border: false,
						items: [{
							xtype: 'label',
							html: "<span style='font-size:14px; color:#383838'>Product Name:</span>"
						},{				
							xtype:'textfield',
							name: 'data[Product][product_name]',
							emptyText: 'Type the name of your new product here',
							anchor: '100%',
							hideLabel: true,
							height: 24,
							style: "margin-top: 4px; margin-bottom: 4px;",
			            },{
							xtype:'fieldset',
							title: 'Basic Information',
							autoHeight: true,
							anchor: '100%',
							layout: 'column',
					        items: [{
								columnWidth:.5,
				                layout: 'form',
								border: false,
				                items: [{
				                    xtype:'textfield',
				                    fieldLabel: 'Item No',
						            name: 'data[Product][item_no]'
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Vendor Item No',
					                name: 'data[Product][vendor_item_no]'
								},{
				                    xtype:'textfield',
					                fieldLabel: 'UPC Code',
					                name: 'data[Product][upc]'
				                }]
							},{
								columnWidth:.5,
				                layout: 'form',
								border: false,
				                items: [{
				                    xtype:'textfield',
				                    fieldLabel: 'FOB Cost',
						            name: 'data[Product][cost]',
									width: 70
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Warehouse Cost',
					                name: 'data[Product][cost_warehouse]',
									width: 70
								}]			
							}]
						},{
							xtype:'fieldset',
							title: 'Shipping Information',
							autoHeight: true,
							anchor: '100%',
							labelWidth: 90,
							layout: 'column',
					        items: [{
								columnWidth:.33,
				                layout: 'form',
								border: false,
								defaults: {width: 60},
				                items: [{
				                    xtype:'textfield',
				                    fieldLabel: 'Item Length',
						            name: 'data[Product][item_length]'
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Item Width',
					                name: 'data[Product][item_width]'
								},{
				                    xtype:'textfield',
					                fieldLabel: 'Item Height',
					                name: 'data[Product][item_height]'
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Duty Code',
					                name: 'data[Product][duty_code]'
				                }]
							},{
								columnWidth:.33,
				                layout: 'form',
								border: false,
								defaults: {width: 60},
				                items: [{
				                    xtype:'textfield',
				                    fieldLabel: 'Package Length',
						            name: 'data[Product][pkg_length]',
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Package Width',
					                name: 'data[Product][pkg_width]',
								},{
				                    xtype:'textfield',
					                fieldLabel: 'Package Height',
					                name: 'data[Product][pkg_height]',
								},{
				                    xtype:'textfield',
					                fieldLabel: 'HTS Number',
					                name: 'data[Product][hts_no]',
								}]			
							},{
								columnWidth:.33,
				                layout: 'form',
								border: false,
								defaults: {width: 60},
				                items: [{
				                    xtype:'textfield',
				                    fieldLabel: 'Net Weight',
						            name: 'data[Product][net_weight]',
				                },{
				                    xtype:'textfield',
					                fieldLabel: 'Gross Weight',
					                name: 'data[Product][gross_weight]',
								},{
				                    xtype:'textfield',
					                fieldLabel: 'Units per Pallet',
					                name: 'data[Product][units_per_pal]',
								},{
				                    xtype:'textfield',
					                fieldLabel: 'Duty Rate',
					                name: 'data[Product][duty_rate]',
								}]			
							}]
						},{
				            xtype:'htmleditor',
							id: 'productdescription',
							name: 'data[Product][description]',
							hideLabel: true,
							width:628,
							height: 116,
							enableColors: false,
							enableFont: false,
							enableFontSize: false,
							enableSourceEdit: false,
							value: 'Type a description here if available.'
						}]
					}],
					border:false,
					listeners: {
						show: function(me) {
							if(me.rendered){
								Ext.getCmp('productdescription').syncSize();
								Ext.getCmp('productdescription').setSize(628,116);
							}
						}
					}
			    },{
/*******************SPECS FORM*******************/
					id: 'card-1',
					autoHeight: true,
					labelAlign: 'top',
					bodyStyle: 'padding:0px;margin:0px;',
					items: [{
					  	xtype: 'editorgrid',
						id: 'specGrid',
						x: -1, y: -1,
						height: 440,
						width: 648,
						layout:'fit',
						cm: new Ext.grid.ColumnModel([{
							id: "spec_name",
							header: "Spec Name",
							dataIndex: 'spec_name',
							width: 295,
							sortable: true,
							editor: new Ext.form.ComboBox({
								store: new Ext.data.JsonStore({
							    	url: 'http://' + host + '/specs/getSpecsSearch',
							    	fields: [{name:'id'},{name:'spec_name'}],
								  	root:'specs'
								}),
								listClass: 'x-combo-list-small',
								displayField:'spec_name',
								minChars: 3,
						        typeAhead:false,
								queryDelay: 200,
						        mode: 'remote',
						        triggerAction: 'all',
								hideTrigger: true,
							})
						},{
							id:'spec_value',
							header: "Spec Value",
							dataIndex: 'spec_value',
							sortable: true,
							width: 341,
							editor: new Ext.form.TextField({
						    	allowBlank: false
							})
						}]),
						ds: new Ext.data.JsonStore({
					        url: 'http://' + host + '/specs/getSpecsForProduct/',
					        root: 'specs',
							id: 'id',
					        fields: ['id', 'spec_id','spec_name','spec_value','product_id']
						}),
						clicksToEdit:1,
						viewConfig: {
							forceFit:true,
							border:false,
						},
						stripeRows: true,
						border:false,
						selModel: new Ext.grid.CellSelectionModel(),
						listeners: {
							afteredit: function(e) {
								Ext.Ajax.request({
									url: 'http://' + host + '/specs/update/'+e.record.data['id'],
									method: 'POST',
									params: {
										'data[ProductsSpec][id]': e.record.data['id'],
										'data[ProductsSpec][spec_id]': e.record.data['spec_id'],
										'data[ProductsSpec][spec_name]': e.record.data['spec_name'],
										'data[ProductsSpec][spec_value]': e.record.data['spec_value'],
										'data[ProductsSpec][product_id]': e.record.data['product_id']
									},
									success:function() {},
									failure: function() {}
								});
						  	}
						},
						tbar:[{
							text:'Add new Spec',
							tooltip:'Add new new specification to Product',
							iconCls:'add',
							handler: function() {
								waitBox('Adding...', 'Please wait', 'Adding new spec to product...');
								Ext.Ajax.request({
									url: 'http://' + host + '/specs/add',
									method: 'POST',
									params: {
										'data[ProductsSpec][id]': '',
										'data[ProductsSpec][spec_id]': '',
										'data[ProductsSpec][spec_name]': 'New Spec (change)',
										'data[ProductsSpec][spec_value]': 'Value (change)',
										'data[ProductsSpec][product_id]': product_id
									},
									success:function() {
										Ext.MessageBox.hide();
										Ext.getCmp('specGrid').getStore().load({
											params:{'product_id':product_id},
											callback: function(r, options, success) {
												Ext.getCmp('specGrid').startEditing(0,0);
											}
										});
									},
									failure: function() {}
								});
								
							}
						},{
							text:'Remove',
							tooltip:'Delete Spec',
							iconCls:'remove',
							handler: function() {
								var cell = Ext.getCmp('specGrid').getSelectionModel().getSelectedCell();
								var rowdata = Ext.getCmp('specGrid').getStore().getAt(cell[0]).data;
								if (rowdata) {
									Ext.MessageBox.confirm('Confirm', 'Are you sure you want to delete this Product Specificaton?',
									function(btn) {
										if(btn == 'yes') {
											waitBox('Deleting', 'Please wait', 'Deleting Product Specification...');
											Ext.Ajax.request({
												url: 'http://' + host + '/specs/delete/'+rowdata.spec_id,
												params:{'product_id':product_id},
												success:function() {
													Ext.MessageBox.hide();
													Ext.getCmp('specGrid').getStore().load({
														params:{'product_id':product_id}
													});
										   		},
												failure: function() {
													Ext.MessageBox.hide();
													Ext.Msg.alert('Status','Specification Delete Failed!');
												}
											});
										}
									});
								}
							}
						}]
					}],
					listeners: {
						show: function(me) {
							if(me.rendered){
								Ext.getCmp('specGrid').syncSize();
							}
						}
					}
			    },{
/*******************CATEGORIES FORM*****************/
					id: 'card-2',
					autoHeight: true,
					items: [{
						border: false,
						id: 'prodCategoriesForm',
						xtype: 'panel',
						layout: 'absolute',
						width: 650,
						height: 525,
						border: false,	
			        	items: [{
							xtype: 'label',
							html: "<span style='font-size: 13px'>Available Categories:</span>",
							x: 10, y: 7
						},{
							id: 'availCats',
							xtype: 'treepanel',
							x: 10, y: 27,
						    autoScroll:true,
						    animate:true,
						    enableDrag:true,
							ddGroup: "categoryDD",
							dragConfig: {ddGroup: "categoryDD"},
							border: true,
							useArrows: true,
							lines: false,
							width: 306,
							height: 428,
						    containerScroll: true,
						    rootVisible: false,
						    loader: new Ext.tree.TreeLoader({
						        dataUrl: 'http://' + host + '/product_categories/getnodes'
						    }),
							root: new Ext.tree.AsyncTreeNode({
						        text:'Categories',
						        draggable:true,
						        id:'-1'
							}),
							recordFromNode: function(n){
								var resultRecord = new Ext.data.Record.create([
									{name: 'product_category_id'},
									{name: 'category_name'},
									{name: 'product_id'}
								]);

								var result = new resultRecord({
									product_category_id: n.attributes.id,
									category_name: n.attributes.text,
									product_id: product_id
								});
								return result;
							}
						},{
							xtype: 'label',
							html: "<span style='font-size: 13px'>Assigned Categories:</span>",
							x: 327, y: 7
						},{
							id: 'assignedCats',
							xtype: 'multiselect',
							store: new Ext.data.Store({	
							    proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/product_categories/getProductCats/'}),
							    reader: new Ext.data.JsonReader({
							    	root: 'prodcats',
									id: 'id',
									fields: ['id', 'product_id','product_category_id','category_name']
								}),
								listeners: {
									add: function(store, records, index) {
										waitBox('Adding...', 'Please wait', 'Adding ' + records[0].get('category_name') + ' Category to Product...');
										Ext.Ajax.request({
											url: 'http://' + host + '/product_categories/assignProductCategory/',
											method: 'POST',
											params: {
												'product_id':product_id,
												'data[ProductsProductCategory][product_category_id]': records[0].get('product_category_id'),
												'data[ProductsProductCategory][category_name]': records[0].get('category_name')				
											},
											success:function() {
												Ext.getCmp('assignedCats').store.load({
													params:{'product_id':product_id}
												});
												Ext.MessageBox.hide();
											},
											failure: function() {}
										});	
								  	}
								}
							}),
							x: 327, y: 27,
							hideLabel: true,
							border: true,
					        name:"multiselect",
					        valueField:"product_category_id",
					        displayField:"category_name",
							dragGroup: "categoryDDtrash",
							dropGroup: "categoryDD",
							allowTrash:false,
					        width:296,
					        height:120
						},{
							xtype: 'label',
							html: "<span style='font-size: 13px'>Associated Tags:</span>",
							x: 327, y: 157
				        },{
							id: 'assignedTags',
							xtype: 'multiselect',
							store: new Ext.data.Store({	
							    proxy: new Ext.data.HttpProxy({url: 'http://' + host + '/product_tags/getProductTags/'}),
							    reader: new Ext.data.JsonReader({
							    	root: 'prodtags',
									id: 'id',
									fields: ['id', 'product_id','product_tag_id','tag_name']
								})
							}),
							x: 327, y: 178,
							hideLabel: true,
							border: true,
					        name:"multiselect",
					        valueField:"product_tag_id",
					        displayField:"tag_name",
							dragGroup: "categoryDDtrash",
							allowTrash:false,
					        width:296,
					        height:120
						},{
							xtype: 'label',
							html: "<span style='font-size: 13px'>Add New Product Tag:</span>",
							x: 327, y: 305
						},{
							id: 'tagsearchcombo',
							xtype: 'combo',
							width: 228,
							x: 327, y: 325,
							store: new Ext.data.JsonStore({
						    	url: 'http://' + host + '/product_tags/getTagsSearch',
						    	fields: [{name:'id'},{name:'tag_name'}],
							  	root:'tags'
							}),
							listClass: 'x-combo-list-small',
							displayField:'tag_name',
							minChars: 3,
					        typeAhead:false,
							queryDelay: 300,
					        mode: 'remote',
					        triggerAction: 'all',
							assignProductTag: function(prod_id, tagname){
								if(tagname)
									tagvalue = tagname;
								else
									tagvalue = this.getRawValue();
								waitBox('Adding...', 'Please wait', 'Assigning Tag to Product...');
								Ext.Ajax.request({
									url: 'http://' + host + '/product_tags/assignProductTag/',
									method: 'POST',
									params: {
										'product_id':product_id,
										'data[ProductTag][tag_name]': tagvalue				
									},
									success: function() {
										Ext.getCmp('assignedTags').store.load({
											params:{'product_id':product_id}
										});
										Ext.MessageBox.hide();
										Ext.getCmp('tagsearchcombo').collapse();
										Ext.getCmp('tagsearchcombo').clearValue();
									},
									failure: function() {}
								});
							},
							listeners: {
								specialkey: function(thisfield, e) {
									if(e.getKey() == 13)
										thisfield.assignProductTag(product_id, null);
								},
								select: function(cmb, rec, ind) {
									var tagname = rec.data.tag_name;
									cmb.assignProductTag(product_id, tagname);
									//Ext.MessageBox.alert('Message', rec.data.tag_name);
								}
							}
						},{
							xtype: 'button',
							text: 'Add Tag',
							style: 'left: 561; top: 325',
							listeners: {
								click: function(btn, e) {
									Ext.getCmp('tagsearchcombo').assignProductTag(product_id, null);
								}
							}	
						},{
						    xtype: 'box',
						    id: 'trashtarget',
						    width: 300, height: 100,
							x: 325, y: 355,
						    autoEl: {
								tag: 'img',
								qtip: 'Drag any Category or Tag onto the trashcan to unassign it from your product',
								src: 'http://' + host + '/img/trashdrag_cats.png'
						    },
							listeners: {
								render: function(me) {
									var dropTarget = new Ext.dd.DropTarget(me.getEl(), {
										copy: false,
										ddGroup: 'categoryDDtrash',
										notifyDrop : function(ddSource, e, data){
											if(data.records) {
												var viewname = data.sourceView.id;
												if (viewname == "assignedCatsview") {
													waitBox('Deleting...', 'Please wait', 'Deleting Category From Product...');
													Ext.Ajax.request({
														url: 'http://' + host + '/product_categories/unassignProductCategory/',
														method: 'POST',
														params: {
															'product_id':product_id,
															'data[ProductsProductCategory][product_category_id]': data.records[0].get('product_category_id'),
															'data[ProductsProductCategory][category_name]': data.records[0].get('category_name')				
														},
														success:function() {
															Ext.getCmp('assignedCats').store.load({
																params:{'product_id':product_id}
															});
															Ext.MessageBox.hide();
														},
														failure: function() {}
													});
												}
												else {
													waitBox('Deleting...', 'Please wait', 'Deleting Tag From Product...');
													Ext.Ajax.request({
														url: 'http://' + host + '/product_tags/unassignProductTag/',
														method: 'POST',
														params: {
															'product_id':product_id,
															'data[ProductsProductTag][product_tag_id]': data.records[0].get('product_tag_id'),
															'data[ProductsProductTag][tag_name]': data.records[0].get('tag_name')				
														},
														success:function() {
															Ext.getCmp('assignedTags').store.load({
																params:{'product_id':product_id}
															});
															Ext.MessageBox.hide();
														},
														failure: function() {}
													});
												}

											}
											return(true);
										}
									})
								}
							}
						}]
					}],
					listeners: {
						show: function(me) {
							if(me.rendered){
								Ext.getCmp('tagsearchcombo').syncSize();
								Ext.getCmp('tagsearchcombo').setWidth(228);
							}
						}
					}
			    },{
					id: 'card-3',
					autoHeight: true,
					
/*******************ATTACHMENTS FORM**********************/
					items: [prodAttachmentsForm],
					listeners: {
						show: function(me) {
							if(me.rendered){
								uploader.setHeight(175);
								uploader.addPostParam('product_id', product_id);
								attachmentsPanel.syncSize();
								Ext.getCmp('prodcatbox').syncSize();
								Ext.getCmp('prodcatbox').setSize(224,22);
							}
						}
					}
			    },{
					id: 'card-4',
					autoHeight: true,
					items: [prodPricesForm]
			    }]
			}]
		});
		
			//Ext.getCmp('card-layout-panel').getTopToolbar().addClass("prodwizardbbar");
			addNewProdWin.show();
			
		}
	
	}
	
}();