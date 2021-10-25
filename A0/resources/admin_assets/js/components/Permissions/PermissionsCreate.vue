<template>
    <v-form
        ref="form"
        v-model="valid"
        @submit="submit"
    >
        <v-row justify="center">
            <v-col
                cols="12"
                md="8"
                sm="10"
            >
                <v-card class="pa-5">
                    <v-text-field
                        label="عنوان"
                        v-model="form.name"
                        outlined
                        shaped
                        :rules="titleRules"
                    ></v-text-field>
                    <v-textarea
                        label="توضیحات"
                        auto-grow
                        outlined
                        rows="3"
                        v-model="form.description"
                        row-height="25"
                        shaped
                    ></v-textarea>
                    <v-btn color="primary" ripple block class="mt-5" :disabled="!valid" @click="submit"
                           :loading="formLoading">ذخیره
                    </v-btn>

                </v-card>
            </v-col>
        </v-row>
    </v-form>

</template>


<script>

    export default {
        name: "CategoriesCreate",
        data() {
            return {
                valid: false,
                formLoading: false,
                form: {
                    name: '',
                    description: '',
                },
                titleRules: [
                    v => !!v || 'عنوان الزامی است',
                ],
            }
        },
        methods: {
            submit() {
                this.formLoading = true;
                axios.post('/admin/permissions/permissions/store', this.form).then(r => {
                    this.formLoading = false;
                    this.$router.push({name: 'permissions.index'});
                });
            }
        },
    }
</script>

