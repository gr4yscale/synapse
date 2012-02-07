/*
  * Ext.ux.DatePickerPlus  Addon
  * Ext.ux.form.DateFieldPlus  Addon  
  *
  * @author    Marco Wienkoop (wm003/lubber)
  * @copyright (c) 2008, Marco Wienkoop (marco.wienkoop@lubber.de) http://www.lubber.de
  *
*/
// Be sure to include this AFTER the datepickerwidget in your html-files

//Use this as a start to create you own language-file.
//Post it to the ext-forum, if you are done! :)
if(Ext.ux.DatePickerPlus){
	Ext.apply(Ext.ux.DatePickerPlus.prototype, {
		weekName : "Wk.",
		selectWeekText : "Click to select all days of this week",
		selectMonthText : "Click to select all weeks of this month",
		maxSelectionDaysTitle: 'Datepicker',
		maxSelectionDaysText: 'You can only select a maximum amount of %0 days',
		undoText: "Undo",
		displayMaskText: 'Please wait...',
		nextYearText: "Next Year (Control+Up)",
		prevYearText: "Previous Year (Control+Down)",
		nationalHolidays: function(year) {
			year = (typeof year === "undefined" ? (this.lastRenderedYear ? this.lastRenderedYear : new Date().getFullYear()) : parseInt(year,10));
	//per default the US national holidays are calculated (according to http://en.wikipedia.org/wiki/Public_holidays_of_the_United_States) 
	//override this function in your local file to calculate holidays for your own country
	//but remember to include the locale file _AFTER_ datepickerplus !
			var dayOfJan01 = new Date(year,0,1).getDay();
			var dayOfFeb01 = new Date(year,1,1).getDay();
			var dayOfMay01 = new Date(year,4,1).getDay();
			var dayOfSep01 = new Date(year,8,1).getDay();
			var dayOfOct01 = new Date(year,9,1).getDay();
			var dayOfNov01 = new Date(year,10,1).getDay();		
	
			var holidays = 
			[{
				text: "New Year's Day",
				date: new Date(year,0,1)
			},
			{
				text: "Martin Luther King Day", //(every third monday in january)
				date: new Date(year,0,(dayOfJan01>1?16+7-dayOfJan01:16-dayOfJan01))
			},
			{
				text: "Washington's Birthday", //(every third monday in february)
				date: new Date(year,1,(dayOfFeb01>1?16+7-dayOfFeb01:16-dayOfFeb01))
			},
			{
				text: "Memorial Day",//(last Monday in May)
				date: new Date(year,4,(dayOfMay01==6?31:30-dayOfMay01))
			},
			{
				text: "Independence Day",
				date: new Date(year,6,4)
			},
			{
				text: "Labor Day",//(every first monday in September)
				date: new Date(year,8,(dayOfSep01>1?2+7-dayOfSep01:2-dayOfSep01))
			},
			{
				text: "Columbus Day",//(every second monday in october)
				date: new Date(year,9,(dayOfOct01>1?9+7-dayOfOct01:9-dayOfOct01))
			},
			{
				text: "Veterans Day",
				date: new Date(year,10,11)
			},
			{
				text: "Thanksgiving Day",//(Fourth Thursday in November)
				date: new Date(year,10,(dayOfNov01>4?26+7-dayOfNov01:26-dayOfNov01))
			},
			{
				text: "Christmas Day",
				date: new Date(year,11,25)
			}];
			
			return holidays;
		}
	});
   
}
