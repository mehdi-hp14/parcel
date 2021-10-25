<template>
    <v-card>
        <v-card-title>
            لیست دسترسی ها
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details

            ></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="items"
            :options.sync="options"
            :server-items-length="total"
            :search="search"
            :loading="loading"
            class="elevation-1"
            :footer-props="{
                    itemsPerPageText:'آیتم در هر صفحه',
                    pageText:perpageText,
                    'prev-icon':'$next',
                    'next-icon':'$prev',
                }"
        >

            <template v-slot:item.actions="{ item }">
                <v-btn color="purple" dark :to="{name: 'roles.edit',params:{'id':item.id}}">
                    <v-icon
                    >
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <ConfirmDelete v-model="showDeleteConfirm" @deleteConfirmed="deleteitem(item.id)"/>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
    import ConfirmDelete from "../Shared/ConfirmDelete";

    export default {
        name: "RolesList",
        components: {ConfirmDelete},
        data() {
            return {
                showDeleteConfirm: false,
                headers: [
                    {
                        text: 'ID',
                        align: 'start',
                        sortable: true,
                        value: 'id',
                    },
                    {
                        text: 'نام',
                        sortable: true,
                        value: 'name',
                    },
                    {
                        text: 'slug',
                        sortable: true,
                        value: 'slug',
                    },
                    {
                        text: 'توضیحات',
                        sortable: true,
                        value: 'description',
                    },
                    {
                        text: '',
                        sortable: false,
                        value: 'actions',
                    },
                ],
                search: '',
                filter: {},
                options: {
                    page: 1,
                    itemsPerPage: 5,
                },
                loading: false,
                timeout: 0,
                total: 0,
                items: [],

            }
        },
        computed: {
            perpageText() {
                return '1-' + this.items.length + ' از ' + this.total
            }
        },
        watch: {
            options(val) {
                this.getDataFromApi();
            },
            search(val) {
                clearTimeout(this.timeout)
                this.timeout = setTimeout(() => {
                    this.options.search = val;
                    this.getDataFromApi();
                }, 500)

            }
        },
        methods: {
            deleteitem(item) {
                console.log(item)
                axios.post('/admin/roles/roles/' + item + '/destroy').then(r => {
                    this.getDataFromApi();
                }).catch(err => {
                    console.log('error happend!')
                    this.loading = true
                })
            },
            getDataFromApi() {
                this.loading = true
                axios.post('/admin/roles/roles/all', this.options).then(r => {
                    this.items = r.data.data
                    this.total = r.data.meta.total
                    this.loading = false
                }).catch(err => {
                    console.log('error happend!')
                    this.loading = true
                })
            },

        },
        mounted() {
            this.getDataFromApi()
        }
    }
</script>
