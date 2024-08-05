/* var player = videojs('my-video', {
	autoplay: 'muted',
	controls: true,
	poster: 'https://picsum.photos/800/450',
	loop: false,
	playbackRates: [0.25, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4],
	plugins: {
		hotkeys: {
			enableModifiersForNumbers: false,
			seekStep: 30
		}
	}
}); */
var player=videojs('my-video',{
						
	playbackRates:[0.25,0.5,1,1.5,2],
	fill:true ,
	aspectRatio:'21:9',
	plugins:{
		hotkeys:{
			enableVolumeScroll:false,
		},
		
	},
})
player.mobileUi({
fullscreen: {
	enterOnRotate: false,
	exitOnRotate: false,
	lockOnRotate: false,
	iOS:false,
	lockToLandscapeOnEnter: false,
	disabled:false,
},
touchControls: {
	seekSeconds: 10,
	tapTimeout: 300,
	disableOnEnd: false,
	disabled: false,
}
});


player.zoom(player);


