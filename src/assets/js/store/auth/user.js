export default
{
	state(){
		return{
			id_usuario: false,
			nb_usuario: 'error',
		}
	},

	getters:
	{
		id_usuario: state => state.id_usuario,
		nb_usuario: state => state.nb_usuario,
	},

	mutations:
	{
		setMsjShow (state, show)
		{
			state.show 	= show
		},
		setMsjColor(state, color)
		{
			state.color = color
		},
		setMsjText(state, text)
		{
			state.text 	= text || 'Ha ocurrido un error'
		},
		setMsjSubText(state, subText)
		{
			state.subText = subText
		},
		setMsjTimeOut(state, timeout)
		{
			state.timeout = timeout
		},
	}
}
