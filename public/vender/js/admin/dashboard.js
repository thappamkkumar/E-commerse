let cards = document.querySelectorAll('.dashboardCard');
		let card_icon = document.querySelectorAll('.dashboardCard_icon_container');
		 var colors = ['rgba(255, 102, 102,1)', 'rgba(255, 204, 102,1)', 'rgba(153, 102, 255,1)', 
		  'rgba(157,200,144,1)', 'rgba(200, 144, 157,1)', 'rgba(102, 255, 204,1)'  ];
		 shuffleArray(colors);
		// Loop through each card and assign a background color
		for (var i = 0; i < cards.length; i++) 
		{ 
			cards[i].style.backgroundColor = colors[i];
			card_icon[i].style.color = colors[i];
		}
		
		function shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
        return array;
    }