export default 
{
    state(){
        return{
            btnModal: false
        }
    },

    getters: 
    {
        getButtom: state => state.btnModal,
    },

    mutations:
    {
        setButtom(state, active)
        {
            state.btnModal = active;
        }
    }
}