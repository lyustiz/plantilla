<template>
  <v-app class="back">
    <v-content>
      <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm6>
                        <v-form @submit.prevent="login()">
                            <v-card class="elevation-12">

                            <v-img :src="ImgPanoramica"></v-img>

                            <v-card-text>

                                <v-text-field
                                    prepend-icon="person"
                                    name="nb_usuario"
                                    label="Usuario"
                                    type="text"
                                    v-model="form.nb_usuario" >
                                </v-text-field>

                                <v-text-field
                                    :append-icon="mostrar ? 'visibility_off' : 'visibility'"
                                    :type="mostrar ? 'text' : 'password'"
                                    @click:append="mostrar = !mostrar"
                                    prepend-icon="lock"
                                    name="password"
                                    label="Contraseña"
                                    id="password"
                                    v-model="form.password">
                                </v-text-field>

                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" dark color="red" >Ingresar </v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>

                        </v-card>
                    </v-form>
                </v-flex>
            </v-layout>
    </v-container>
    </v-content>
    <pre>
    {{$data.test}}
</pre>
</v-app>

</template>
<script>
module.exports = {
    data()
    {
        return{
            mostrar: false,
            test:[],
            form:
            {
                nb_usuario:null,
                password:null
            },
            error:
            {
                nb_usuario:null,
                password:null
            },
            ImgPanoramica: require('../../img/panoramica.png'),
        }
    },
    methods:{
        login()
        {
            urlBase='login';
            axios.post(urlBase, this.form)
            .then(respuesta =>
            {
                if (respuesta.status == 200)
                {
                    window.location='/home'
                }
                else
                {
                    alert('eroor'.respuesta.status)
                }
            })
            .catch(error =>
            {
                this.test = error
            })
        }
    }
}
</script>
