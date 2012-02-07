

Synapse.Products = function(){	
	product_id = 1;
	
    return {
        init : function() {

			navPanel = new Ext.Panel({
				bodyStyle: 'border-bottom:0 none; border-top:0 none;',
			 	region:"west",
				layout:'accordion', 
			    width:300,
			    split:true,
			    collapsible:true,
				border: false,
				layoutConfig: {
					animate: false
				},
				defaults: {
			        bodyStyle: 'padding:8px;',
					border: false,
					//autoHeight: true,
				},
				items:[{
					title: '&raquo; Live Text Search',
					xtype: 'form',
					height: 136,
					bodyStyle: 'border-bottom:1px dotted #B5B8C8; background-color: #e1e1e1; padding: 8px; padding-bottom: 8px',
					items:[{
						xtype:'textfield',
						id: 'searchterms',
						enableKeyEvents: true,
						hideLabel: true,
						value: "Type your search here.",
						width: 280, height: 24,
						style: "margin-top: 4px; margin-bottom: 4px; font-size: 13px; padding-left: 6px; padding-right: 6px; color: #555555",
						listeners: {
							keyup: function(thisfield, e) { 
								if(this.getValue ().length > 2) {
									prodDS.proxy.conn.url = 'http://' + host + '/products/getProductSearch/';
									prodDS.load({params:{'searchterms':this.getValue ()}});	
								}
								else
									prodDS.removeAll();
							},
							focus: function(thisfield) { 
								if(this.getValue () == "Type your search here.")
									this.setValue("");
							}
						}
					},{
						xtype: 'checkboxgroup',
		               	hideLabel: true,
		                columns: 2,
		                vertical: false,
						cls: 'cbgroupdark',
						defaults:{height: 20},
		                items: [
							{boxLabel: 'Item No', name: 'cb-search-itemno', checked: true},
		                    {boxLabel: 'Vendor Item No', name: 'cb-search-vendoritemno', checked: true},
							{boxLabel: 'Name', name: 'cb-search-name', checked: true},
							{boxLabel: 'UPC', name: 'cb-search-upc'},
							{boxLabel: 'Tags', name: 'cb-search-tags', checked: true},
							{boxLabel: 'Groups', name: 'cb-search-groups', style: "font-size:8px"},
		                    {boxLabel: 'Description', name: 'cb-search-desc'}				
		                ]
					},{
						xtype: 'panel',
						autoHeight: true,
						border: true,
						bodyStyle: 'border-bottom:1px dotted #B5B8C8; border-top:1px dotted #B5B8C8; border-left: 0px none; border-right: 0px none; background-color: #E8E8E8; margin-top: 2px; padding: 4px; padding-bottom: 8px',
						html: "<span style='font-size: 14px;'>Recent Searches:</span><br><a href='#' onClick=\"prodDS.load({params:{'searchterms':'jack'}});\"><span class='livesearchrecents'>Jack</span></a>, <span class='livesearchrecents'>Floor Stand</span>, <span class='livesearchrecents'>Toolbox</span>, <span class='livesearchrecents'>Testing</span>, <span class='livesearchrecents'>Another Search</span>, <span class='livesearchrecents'>Testing again</span>"
					},{
						xtype: 'panel',
						autoHeight: true,
						border: true,
						bodyStyle: 'border-bottom:1px dotted #B5B8C8; border-top:1px dotted #B5B8C8; border-left: 0px none; border-right: 0px none; background-color: #E8E8E8; margin-top: 4px; padding: 4px; padding-bottom: 8px;',
						items: [{
							xtype: 'panel',
							border: false,
							html: "<span style='font-size: 14px;'>Saved Searches:</span><br><span class='livesearchrecents'>Search blah</span>, <span class='livesearchrecents'>Testing</span>, <span class='livesearchrecents'>Another Search</span>"
						},{
							xtype: 'button',
							text: 'Save Current Search',
							style: 'margin-top: 8px;',
							listeners: {
								click: function(btn, e) {
								//	tagsearchcombo.assignProductTag(product_id, null);
								}
							}			
						}]	
					}]
				
				},{
					title: '&raquo; Category Search',
					id: 'categorysearch',
					xtype: 'form',
					autoScroll: true,
					bodyStyle: 'padding: 0px none;',
					items:[{
						xtype: 'treepanel',
						bodyStyle: 'padding: 6px; background: transparent; border: 0 none;',
						cls: 'prodSearchCats',
				        autoScroll:true,
				        animate:true,
						autoHeight: true,
				        enableDD:false,
						border: true,
						style: 'margin-top: 4px',
						margin: '0 0 0 0',
				        containerScroll: true,
				        rootVisible: false,
				        loader: new Ext.tree.TreeLoader({
				            dataUrl: 'http://' + host + '/product_categories/getnodes'
				        }),

						root: new Ext.tree.AsyncTreeNode({
					        text:'Categories',
					        draggable:false,
					        id:'-1'
						}),
				
						listeners: {
							click: function(thenode, e) {
								prodDS.proxy.conn.url = 'http://' + host + '/products/getProductsByCategory/';
								prodDS.load({
									params:{'searchcat_id':thenode.id}
								});
							}
						}
					}]

				},{					
					title: '&raquo; Product Grouping',
					xtype: 'form',
					bodyStyle: 'background-color: #e1e1e1',
					items:[{
						xtype: 'panel',
						id: 'prodgrouping',
						layout: 'absolute',
						bodyStyle: 'background-color: #E8E8E8; border: 0px none; border-bottom:1px dotted #B5B8C8;',
						width: 300,
						height: 220,						
						border: true,
						selectedProds: new Array(),
						clearGrpItems: function(){
							if(Ext.getCmp('groupdetails').items){
								var f;
								while(f = Ext.getCmp('groupdetails').items.first()){
								  Ext.getCmp('groupdetails').remove(f, true);
								}
							}
						},
						items:[{
							xtype: 'box',
							width: 236, height: 163,
							x: 30, y: 30,
						    autoEl: {
								tag: 'img',
								qtip: 'Drag products into drop box to create a group',
								src: 'http://' + host + '/img/proddrag_groups.png',
						    },
							listeners: {
								render: function(me) {
									prevIndex = 0;
									add = true;
									var groupDropTarget = new Ext.dd.DropTarget(me.getEl(), {
										copy: false,
										ddGroup: 'groupingDD',
										notifyDrop : function(ddSource, e, data){
											for(i=0;i < data.selections.length;i++){					
												Ext.getCmp('prodgrouping').selectedProds[prevIndex] = data.selections[i];
												prevIndex++;
											}
									
											Ext.getCmp('prodgrouping').clearGrpItems();	
			
											Ext.getCmp('prodgrouping').selectedProds = Ext.getCmp('prodgrouping').selectedProds.uniq();
									
											for(i=0;i < Ext.getCmp('prodgrouping').selectedProds.length;i++){											
												Ext.getCmp('groupdetails').add({
													xtype: 'panel',
													border: false,
													id: 'grpitem-' + Ext.getCmp('prodgrouping').selectedProds[i].data.id,
													html: "<img src='../img/mini_icons/delete.gif' style='vertical-align: top; border: 0px;'> " + Ext.getCmp('prodgrouping').selectedProds[i].data.product_name	
												});
											}	
									
											Ext.getCmp('groupdetails').doLayout();
											Ext.getCmp('groupdetails').show();
								
											return(true);
										},
									})
								}
							}
				
						}]
					},{
						xtype: 'panel',
						id: 'groupdetails',
						hidden: true,
						bodyStyle: 'background-color: #E8E8E8; border: 0px none; border-bottom:1px dotted #B5B8C8; border-top:1px dotted #B5B8C8;padding: 10px; font-size: 14px; color:#444444;',
						width: 300,
						autoHeight: true,						
						border: true,
						tbar: new Ext.Toolbar({
							id: 'groupnametbar',
							hidden: false,							
							items: [{
								xtype:'textfield',
								id: 'newgroupname',
								enableKeyEvents: true,
								hideLabel: true,
								value: "Type product group name here",
								width: 234,
								style: "margin-left: 2px; margin-top: 2px; margin-bottom: 2px; padding-left: 6px; padding-top: 2px; padding-right: 6px; color: #555555; height: 22; font-size: 13px; line-height: 22, vertical-align: middle",
								listeners: {
									focus: function(t) {
										t.setValue('');
									}
								}
							},{				
								xtype: 'button',
								text: 'Save',
								iconCls:'add',
								style: 'margin-left: 2px; margin-right: 2px; padding-right:2px;',
								listeners: {
									click: function(btn, e) {
										prodIDs = new Array();
										var prods = Ext.getCmp('prodgrouping').selectedProds;	

										for(i=0;i<prods.length;i++)
											prodIDs[i] = prods[i].data.id;
									
										Ext.Ajax.request({
											url: 'http://' + host + '/products/createGroup/',
											params:{
												'group_name': Ext.getCmp('newgroupname').getValue(),
												'selectedProds[]': prodIDs
											},
											success: function() {
												Ext.getCmp('prodgrouping').clearGrpItems();
												Ext.getCmp('groupdetails').add({
													xtype: 'panel',
													border: false,
													bodyStyle: 'text-align: center; font-size: 18px; color:#555555;',
													html: "Group has been created successfully."	
												});
												Ext.getCmp('groupdetails').doLayout();
												Ext.getCmp('newgroupname').setValue('Type product group name here');
												Ext.getCmp('groupdetails').getTopToolbar().hide();
												prodDS.load(prodDS.lastOptions);
											},
											failure: function() {}
										});
									}
								}
							}]
						}),
						html: ""
					}]
				}]
			});
	

			var precord = Ext.data.Record.create([
		     	{name: 'id'},
		   		{name: 'item_no'},
		   		{name: 'vendor_item_no'},
		     	{name: 'prod_thumbsrc'},
		     	{name: 'product_name'},
		     	{name: 'cost', type: 'float'},
		     	{name: 'parent_id', type: 'auto'},
		     	{name: 'leaf', type: 'bool'}
		   	]);


		    var prodDS = new Ext.ux.maximgb.treegrid.AdjacencyListStore({
		    	url: 'http://' + host + '/products/getProductSearch/',
		        reader: new Ext.data.JsonReader({
					id: 'id',
					root: 'products',
					totalProperty: 'total',
					successProperty: 'success',
					leaf_field_name: 'leaf',
					parent_id_field_name: 'parent_id'
				}, 
				precord)
		    });

			prodDS.load();

			var prodgrid = new Ext.ux.maximgb.treegrid.GridPanel({
				bodyStyle: 'padding: 0 none; margin 0 none; padding-top: 3px;',
				cls: 'prodGridCls',
				store: prodDS,
				master_column_id: 'item_no',
				columns: [
			//		{id:'id',header: "id", width: 50, sortable: true, dataIndex: 'id'},
					{id: 'prod_thumbsrc', header: "Image", width: 73, renderer: prodThumb, dataIndex: 'prod_thumbsrc'},
				  	{id: 'item_no', header: "Item No.", width: 110, sortable: true, dataIndex: 'item_no'},
			  //	{header: "Vendor No.", width: 75, sortable: true, dataIndex: 'vendor_item_no'},
					{id: 'product_name', header: "Product Name", width: 160, sortable: true, dataIndex: 'product_name'},
				  	{id: 'cost', header: "Cost", width: 75, sortable: true, dataIndex: 'cost'}
				],
				stripeRows: true,
				enableDragDrop: true,
				ddGroup: 'groupingDD',
				trackMouseOver: false,
				autoExpandColumn: 'product_name',
				root_title: 'Products',
				border:false
			});
		
			function prodThumb(val, meta, record) {
				if(val)
					val = "<img src='" + wwwroot + "attachments/products/" + record.data['id'] + "/thumbs/s_" + val + "' class='prodGridThumb'>";
				else
					val = "<img src='" + wwwroot + "img/noprodthumb.png' class='prodGridThumb'>";
				return val;
			}

	
			mainGridPanel = new Ext.Panel({
				id: 'prodgridpanel',
		        region: 'center',
				layout: 'fit',
				border: false,
				items:[prodgrid]			
		    });			
	
			detailsPanel = new Ext.Panel({
				bodyStyle: 'margin-left:50%; width: 100%; left: -75px; top: 25px; font-size: 28px; color:#b4b4b4',
		        region: 'south',
		        height:100,
		        split: true,
				border:false,
		        layout:'fit',
		        collapsible: true,
				html: 'Details Here'
			});
			
			centerPanel = new Ext.Panel({
		        layout:'border',
		        border:false,
		        items: [mainGridPanel, detailsPanel]
		    });
		
			Synapse.Base.init();
		
			Synapse.Base.addComponent("mainview-west", navPanel, {width:300, split:true, collapsible:true, border: false});
			Synapse.Base.addComponent("mainview-center", centerPanel, {border: false});
			
			Load ('http://' + host + '/js/Synapse.class.Products.js');

	}
}
	
}();



Ext.onReady(Synapse.Products.init, Synapse.Products);


