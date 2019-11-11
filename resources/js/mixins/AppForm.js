import AppFormat  from './AppFormat';
import AppRules   from './AppRules'
import AppSelect  from './AppSelect'
import AppMessage from './AppMessage'

export default {
    mixins: [AppFormat, AppRules, AppSelect, AppMessage],
    created()
    {
        this.fillSelects()
        /*this.rstForm();
        this.basePath += this.tabla
        this.form.id_usuario = 1;*/
    },
    data() {
        return {

            id_usuario: 1,//this.$store.getters.user.id_usuario,
            valid:      true,
            calendar:   false,
            dates:      {},
        }
    },
	
    props: {
        item: {
            type: Object,
            default: null
        },
        action: {
            type: String,
            default: null
        },
		title: {
            type: String,
            default: null
        },
	},

    watch: {
        action (value)
        {
            this.mapForm()
			
			//this.btnAccion = val;

            /*if(val=='upd')
            {
                this.mapForm();
            }else
            {
                this.clear();
            }*/
        },

        /*item (val) {
            this.mapForm()
        }*/
    },
	computed: 
	{
        fullUrl() 
		{
            return this.$App.baseUrl + this.resource;
        },
		
        fullUrlId() 
		{
            return this.fullUrl + '/' + this.item['id_' + this.resource]
        },
    },
    methods: 
	{
        mapForm()
        {
            if(this.item)
            {
                for(var key in this.item)
                {
                    if(this.form.hasOwnProperty(key))
                    {
                        if(key.includes('fe_') && this.item[key].length > 10)
                        {
                            this.dates[key] =  this.formatDate(this.item[key]);
							
							this.form[key] = this.item[key].substr(0, 10);
							
                        } else {
							
							this.form[key]  =  this.item[key];
						}
                    }
                }
            }else
            {
                this.reset()
            }
        },
				
		store() 
		{
            if (this.$refs.form.validate()) 
			{
                this.loading = true;
				
                axios.post(this.fullUrl, this.form)
                    .then(response => 
					{
                        this.validResponse(response)
						
                    }).catch(error => {
						
                        this.showError(error);
                    })
            }
        },
		
        update() 
		{
            if (this.$refs.form.validate()) 
			{
                this.loading = true;
				
                axios.put(this.fullUrlId, this.form)
                    .then(response => 
					{
                        this.validResponse(response)
						
                    }).catch(error => {
						
                        this.showError(error);
                    })
            }
        },
        
        reset()
        {
            for(var key in this.form)
            {
                this.form[key] = null;
            }

            for(var key in this.dates)
            {
                this.dates[key] = null;
            }
            //this.$refs.form.reset();
            this.form.id_usuario = 1
        },
		
        clear ()
        {
            this.$refs.form.reset();
            this.reset();
        },
		
        cancel()
        {
            this.$emit('modalClose');
            this.clear();
        },
    }
}
