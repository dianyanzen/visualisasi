var regions=[
   	{
        "region_name": "Kecamatan Sukasari",
        "region_code": "Kec_Sukasari",
        "population": 92634,
		
    },
	{
        "region_name": "Kecamatan Cidadap",
        "region_code": "Kec_Cidadap",
        "population": 62812,
	
    },
    {
        "region_name": "Kecamatan Sukajadi",
        "region_code": "Kec_Sukajadi",
        "population": 119918,
		
    },
    {
        "region_name": "Kecamatan Coblong",
        "region_code": "Kec_Coblong",
        "population": 156164,
		
    },
    {
        "region_name": "Kecamatan Cibeunying Kaler",
        "region_code": "Kec_Cibeunying_Kaler",
        "population": 85373,
		
    },
    {
        "region_name": "Kecamatan Bandung Wetan",
        "region_code": "Kec_Bandung_Wetan",
        "population": 44731,
		
    },
    {
        "region_name": "Kecamatan Mandalajati",
        "region_code": "Kec_Mandalajati",
        "population": 88949,
		
    },
    {
        "region_name": "Kecamatan Cibeunying Kidul",
        "region_code": "Kec_Cibeunying_Kidul",
        "population": 137871,
		
    },
    {
        "region_name": "Kecamatan Ujung Berung",
        "region_code": "Kec_Ujung_Berung",
        "population": 101177,
		
    },
    {
        "region_name": "Kecamatan Cibiru",
        "region_code": "Kec_Cibiru",
        "population":  	100632,
		
    },
    {
        "region_name": "Kecamatan Sumur Bandung",
        "region_code": "Kec_Sumur_Bandung",
        "population": 47490,
		
    },
    {
        "region_name": "Kecamatan Regol",
        "region_code": "Kec_Regol",
        "population": 117616,
	
    },
    {
        "region_name": "Kecamatan Astana Anyar",
        "region_code": "Kec_Astana_Anyar",
        "population": 91489,
		
    },
    {
        "region_name": "Kecamatan Bojongloa Kidul",
        "region_code": "Kec_Bojongloa_Kidul",
        "population": 102946,
		
    },
    {
        "region_name": "Kecamatan Bojongloa Kaler",
        "region_code": "Kec_Bojongloa_Kaler",
        "population": 144920,
		
    },
    {
        "region_name": "Kecamatan Babakan Ciparay",
        "region_code": "Kec_Babakan_Ciparay",
        "population": 161086,
		
    },
    {
        "region_name": "Kecamatan Bandung Kulon",
        "region_code": "Kec_Bandung_Kulon",
        "population": 69713,
		
    },
    {
        "region_name": "Kecamatan Batununggal",
        "region_code": "Kec_Batununggal",
        "population":  	150179,
		
    },
    {
        "region_name": "Kecamatan Bandung Kidul",
        "region_code": "Kec_Bandung_Kidul",
        "population": 69713,
		
    },
    {
        "region_name": "Kecamatan Kiaracondong",
        "region_code": "Kec_Kiaracondong",
        "population": 155408,
		
    },
	{
        "region_name": "Kecamatan Buah Batu",
        "region_code": "Kec_Buah_Batu",
        "population": 134350,
		
    },
	{
        "region_name": "Kecamatan Antapani",
        "region_code": "Kec_Antapani",
        "population": 91721,
		
    },
	{
        "region_name": "Kecamatan Rancasari",
        "region_code": "Kec_Rancasari",
        "population": 111105,
		
    },
	{
        "region_name": "Kecamatan Gedebage",
        "region_code": "Kec_Gedebage",
        "population": 50229,
	
    },
	{
        "region_name": "Kecamatan Arcamanik",
        "region_code": "Kec_Arcamanik",
        "population": 91999,
		
    },
	{
        "region_name": "Kecamatan Cinambo",
        "region_code": "Kec_Cinambo",
        "population": 29853,
		
    },
	{
        "region_name": "Kecamatan Panyileukan",
        "region_code": "Kec_Panyileukan",
        "population": 46166,
		
    },
	{
        "region_name": "Kecamatan Andir",
        "region_code": "Kec_Andir",
        "population": 135918,
		
    },
	{
        "region_name": "Kecamatan Cicendo",
        "region_code": "Kec_Cicendo",
        "population": 124224,
	
    },
		{
        "region_name": "Kecamatan Lengkong",
        "region_code": "Kec_Lengkong",
        "population": 100681,
		
    },
];


var temp_array= regions.map(function(item){
    return item.population;
});
var highest_value = Math.max.apply(Math, temp_array);

$(function() {

    for(i = 0; i < regions.length; i++) {

        $('#'+ regions[i].region_code)
        .data('region', regions[i]);
    }

    $('.map g').mouseover(function (e) {
        var region_data=$(this).data('region');
        $('<div class="info_panel">'+
            region_data.region_name + '<br>' +
          	'Jumlah Penduduk: ' + region_data.population.toLocaleString("en-UK") 
         )
        .appendTo('body');
    })
    .mouseleave(function () {
        $('.info_panel').remove();
    })
    .mousemove(function(e) {
        var mouseX = e.pageX, //X coordinates of mouse
            mouseY = e.pageY; //Y coordinates of mouse

        $('.info_panel').css({
            top: mouseY-50,
            left: mouseX - ($('.info_panel').width()/2)
        });
    });

});