Ext.BLANK_IMAGE_URL = 'http://' + host + '/js/ext-2.2/resources/images/default/s.gif';

Ext.namespace('Synapse', 'Synapse.Products');


function dumpProps(objName) {
	var obj = eval(objName)
	for (var i in obj) {
		if (i != "outerHTML" && i != "outerText" && i != "innerHTML" && i != "innerText" && i != "domain") {
			console.log(objName + "." + i + "=" + obj[i] + "\n");
		}
	}
}

function waitBox(msg, title, progress) {
	Ext.MessageBox.show({
	   title: title,
       msg: msg,
       progressText: progress,
       width:300,
       progress:true,
       closable:false
    });
};


Synapse.Base = function() {
    var viewport;

    return {
        init : function() {
			Ext.QuickTips.init();
			this.initLayout();
        },

        initLayout: function() {

			var logotxtsrc = wwwroot + "img/logo_text_home.png";
			var menuiconsloc = 'http://' + host + '/img/menu_icons/';
			
			if(url == "products")
				logotxtsrc = wwwroot + "img/logo_text_products.png";
			
			//preload mouseovers for top dock				
			var i = 0;
			imageObj = new Image();

			images = new Array();
			images[0] = menuiconsloc + '01_menu_home_o.png';
			images[1] = menuiconsloc + '02_menu_mail_o.png';
			images[2] = menuiconsloc + '03_menu_cal_o.png';
			images[3] = menuiconsloc + '04_menu_vendors_o.png';
			images[4] = menuiconsloc + '05_menu_contacts_o.png';
			images[5] = menuiconsloc + '06_menu_quotes_o.png';
			images[6] = menuiconsloc + '07_menu_products_o.png';
			images[7] = menuiconsloc + '08_menu_orders_o.png';
			images[8] = menuiconsloc + '09_menu_reports_o.png';
			images[9] = menuiconsloc + '10_menu_travel_o.png';

			for(i=0; i<=9; i++){
			     imageObj.src=images[i];
			}
			
            viewport = new Ext.Viewport({
                defaults:{
                    frame:false,
                    border:false,
                    split:true, //have to set the splitbar here, otherwise we cannot hide / show it later
                    collapsible: false,
                    hidden:true,
                    layout:"fit" ,
                    margins:'0 0 0 0'
                },
                layout:'border',
                items:[{
					id: 'headerPanel',
					bodyStyle: "background:transparent url(" + wwwroot + "img/headerbg3.png);",
				    region:'north',
				    border:false,
					hidden: false,
					layout:'absolute',
					height: 124,
					width: '100%',
					items: [{
						xtype: 'box',
					    id: 'logo',
					    width: 300, height: 97,
						x: 30, y: 0,
					    autoEl: {
							tag: 'img',
							src: wwwroot + "img/synapse_logo.png"
					    }
					},{
						xtype: 'box',
					    id: 'logotext',
					    width: 179, height: 26,
						x: 186, y: 68,
					    autoEl: {
							tag: 'img',
							src: logotxtsrc
					    }
					},{
						xtype: 'panel',
					    id: 'icons',
						style:'margin-top: 18px; left:338px; border: 0 none;',
						bodyStyle: 'background: transparent none;',
						border: false,
						layout:'column',
					    items: [{
						    xtype: 'box',
						    id: 'menuicon1',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '01_menu_home.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									if(url == "")
										c.getEl().dom.src = menuiconsloc + '01_menu_home_o.png';
									c.getEl().on('click', function() {
										window.location = "http://" + host;
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '01_menu_home_o.png';
									});
									c.getEl().on('mouseout', function() {
										if(url != "")
											c.getEl().dom.src = menuiconsloc + '01_menu_home.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon2',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '02_menu_mail.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '02_menu_mail_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '02_menu_mail.png';
									});		
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon3',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '03_menu_cal.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '03_menu_cal_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '03_menu_cal.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon4',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '04_menu_vendors.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '04_menu_vendors_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '04_menu_vendors.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon5',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '05_menu_contacts.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '05_menu_contacts_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '05_menu_contacts.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon6',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '06_menu_quotes.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '06_menu_quotes_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '06_menu_quotes.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon7',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '07_menu_products.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									if(url == "products")
										c.getEl().dom.src = menuiconsloc + '07_menu_products_o.png';
									c.getEl().on('click', function() {
										window.location = "http://" + host + "/products/";
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '07_menu_products_o.png';
									});
									c.getEl().on('mouseout', function() {
										if(url != "products")
											c.getEl().dom.src = menuiconsloc + '07_menu_products.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon8',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '08_menu_orders.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '08_menu_orders_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '08_menu_orders.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon9',
						    width: 51, height: 77,
							cls: 'menuicon',
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '09_menu_reports.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '09_menu_reports_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '09_menu_reports.png';
									});
								}
							}
						},{
						    xtype: 'box',
						    id: 'menuicon10',
						    width: 51, height: 77,
						    autoEl: {
								tag: 'img',
								src: menuiconsloc + '10_menu_travel.png'
						    },
							style: 'cursor:pointer;',
							listeners: {
								render: function(c) {
									c.getEl().on('click', function() {
										Ext.MessageBox.alert('Ooops!', 'Section not active yet.');
									});
									c.getEl().on('mouseover', function() {
										c.getEl().dom.src = menuiconsloc + '10_menu_travel_o.png';
									});
									c.getEl().on('mouseout', function() {
										c.getEl().dom.src = menuiconsloc + '10_menu_travel.png';
									});
								}
							}
						}]
					},{
					    id: 'moduletext',
						border: false,
						bodyStyle: 'background: transparent; color: #383838;font-size:14px; text-align: left; padding-right: 16px; padding-left: 16px;',
						x: 0, y: 100,
						width: '100%',
						html: "Product Search & Management &raquo; <a style='color:#000;font-size:13px;' href='javascript:Synapse.NewProdDialog.init();'>Add Product</a> &#x95; <a style='color:#000;font-size:13px;' href=\"javascript:alert('not implemented yet')\">Manage Categories</a>"

					}]
				},{
                    region:'east',
                    id:'mainview-east',
                    title:"-"
                },
                {
                    region:'south',
                    id:'mainview-south',
                    title:"-"
                },
                {
                    region:'west',
                    id:'mainview-west',
                    title:"-",
					margins:'-1 0 0 0'
                },
                {
                    region:'center',
                    id:'mainview-center',
                    hidden:false,
                    title:"-",
					margin: '-1 0 0 0',
                    collapsible:false

                }
                        ]
            });

            //hide split bars for all regions; we can re-enable them later on demand
            this.hideSplitBars();
        },

        hideSplitBars : function(){
            viewport.layout.north.splitEl.hide();
            viewport.layout.east.splitEl.hide();
            viewport.layout.south.splitEl.hide();
            viewport.layout.west.splitEl.hide();
        },

    /**
     * Adds a component to the main application
     * @param {String} id of the container within which the panel should be added
     * @param {Object} component component to add
     * @param {Object} containerCfg configuration for the container that will contain the component
     */
        addComponent : function(id, component, containerCfg) {
            var defaults = {
                collapsible : false,
                title : false,
                width : 100,
                height : 100,
                split:false
            }
            var cfg = {};

            Ext.apply(cfg, containerCfg, defaults);

            var container = Ext.getCmp(id);

            if (cfg.title) {
                container.setTitle(cfg.title);
            }
            else {
                container.header.visibilityMode = Ext.Element.DISPLAY;
                container.header.hide();
                //container.body.addClass(container.bodyCls + '-noheader');
            }

            container.setSize(cfg.width, cfg.height);
            container.add(component);
            container.show();

            // show or hide splitter
            var splitEl = container.ownerCt.layout[container.region].splitEl;

            if (splitEl) {
                if (cfg.split) {
                    splitEl.show();
                }
                else {
                    splitEl.hide();
                }
            }

            container.doLayout();
            container.ownerCt.doLayout();
        }
    };
}();

