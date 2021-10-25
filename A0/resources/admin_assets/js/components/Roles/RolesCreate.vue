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
                    <v-combobox
                        v-model="form.permissions"
                        :items="permissionItems"
                        :rules="permissionRules"
                        :loading="permissionIsLoading"
                        :search-input.sync="searchPermission"
                        chips
                        deletable-chips
                        multiple
                        label='permissions'></v-combobox>

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
                permissionIsLoading: false,
                permissionItems: [],
                formLoading: false,
                searchPermission: false,
                form: {
                    name: '',
                    permissions: [],
                },
                titleRules: [
                    v => !!v || 'عنوان الزامی است',
                ],
                permissionRules: [
                    v => {
                        return !!v.length || 'انتخاب تگ الزامی است'
                    },
                ],
            }
        },
        computed() {

        },
        watch: {
            searchPermission: {
                handler(val) {

                    if (this.permissionIsLoading) return
                    this.permissionIsLoading = true
                    // Lazily load input items

                    axios.post('/admin/roles/roles/search-permissions', {val})
                        .then(res => {
                            this.count = res.data.length
                            this.permissionItems = res.data.data
                        })
                        .catch(err => {
                            console.log(err)
                        })
                        .finally(() => (this.permissionIsLoading = false))
                },
                immediate: true
            }
        },
        methods: {
            submit() {
                this.formLoading = true;
                axios.post('/admin/roles/roles/store', this.form).then(r => {
                    this.formLoading = false;
                    // this.$router.push({name: 'roles.index'});
                });
            }
        },
    }
</script>

