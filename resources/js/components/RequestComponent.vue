<template>
    <v-form v-model="valid">
        <v-container>
            <v-row>
                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        :counter="10"
                        label="Имя"
                        required
                    ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="phone"
                        :counter="10"
                        label="Телефон"
                        required
                    ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="text"
                        label="Обращение"
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    cols="12"
                    md="4">
                    <v-select
                        :items="savePlaces"
                        label="Место хранения"
                    ></v-select>
                </v-col>
                <v-col
                    cols="12"
                    md="4">
                    <v-btn @click="sendRequest">Отправить</v-btn>
                </v-col>

            </v-row>
        </v-container>
    </v-form>
</template>

<script>
    export default {
        name: "RequestComponent",
        data: () => ({
            valid: false,
            name: '',
            phone: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => v.length <= 5 || 'Name must be less than 5 characters',
            ],
            text: '',
            savePlaces: []
        }),
        created() {
            this.getData();
        },
        methods: {
            getData: function () {
                fetch('/request/getPlaces/')
                    .then((response) => {
                        if (response.ok) {
                            return response.json();
                        }

                        throw new Error('Network response was not ok');
                    })
                    .then((json) => {
                        if (json) {
                            this.savePlaces = [];
                            // json.forEach(place => {
                            // this.savePlaces = Object.entries(json);
                            let places = Object.entries(json);
                            places.forEach(place => {
                                this.savePlaces.push({item: place[1], text: place[0]});
                            });
                        }
                    })
                    .catch((error) => {

                        console.log(error);
                    })

            },
            sendRequest: function () {
                let params = new URLSearchParams();
                params.append('name', this.name);
                params.append('phone', this.phone);
                params.append('text', this.text);
                axios.post('/request/save/', params)
                    .then(response => {
                    })
                    .catch(error => {
                    });
                // console.log('sendRequest');
            }
        }
    }
</script>

<style scoped>

</style>
