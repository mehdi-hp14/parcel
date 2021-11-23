let $ = require('jquery');
import Vue from 'vue';
import _ from 'lodash';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import axios from 'axios';

Vue.component('v-select', vSelect)

new Vue({
// components:[VSelect],
    data() {
        return {
            selectedCsv: [],
            options: window.selectedUser ? [{
                fname: window.selectedUser.fullName,
                uname: window.selectedUser.uname
            }] : [],
            selectedUser: window.selectedUser ? window.selectedUser.uname : null,
            countries:window.countries,
            collectionLocations:window.collectionLocations,
            selectedFromCountries:window.selectedFromCountries || [],
            selectedToCountries:window.selectedToCountries || [],
            selectedCollectionLocations:window.selectedCollectionLocations || [],
        }
    },

    methods: {
        exportSelectedCsv() {
            const csvArray = [];

            this.selectedCsv.forEach(id => {

                const item = $('#csv-mark-' + id);

                item.parent().parent().find('[data-csv-key]').each((key, item) => {
                    // debugger
                    let first = escapeCsv(item.querySelector('.title').innerText);

                    let second = escapeCsv(item.querySelector('[data-csv-value]').innerText);

                    csvArray.push('"' + first + '"' + ',' + '"' + second + '"')

                });
                csvArray.push('' + ',' + '');

                // that.exportCsvOperation(csvArray);
                //
                // let firsttt = escapeCsv(item.find($('.title')).text());
                //
                // let second = escapeCsv(item.find('[data-csv-value]').text());
                //
                // csvArray.push('"' + firsttt + '"'+','+'"' + second + '"')


            });
            this.exportCsvOperation(csvArray);

        },
        exportCsvOperation(csvArray) {
            var csv_string = csvArray.join('\n');

            var filename = 'export_instruction_' + new Date().toLocaleDateString() + '.csv';
            var link = document.createElement('a');
            link.style.display = 'none';
            link.setAttribute('target', '_blank');
            link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        onSearch(search, loading) {
            if (search.length) {
                loading(true);
                this.search(loading, search, this);
            }
        },
        search: _.debounce((loading, search, vm) => {
            vm.selectedUser=null;

            axios.get(window.reportUserApi + `?q=${escape(search)}`).then(res => {
                vm.options = res.data
                loading(false)

            }).catch(err => {

            })
        }, 350)
    },
    mounted() {
        const that = this;
        $(document).ready(function () {
            $('#export-csv').on('click', function (e) {
                e.preventDefault();

                const csvArray = [];
                document.querySelectorAll('[data-csv-key]').forEach(item => {
                    let first = escapeCsv(item.querySelector('.title').innerText);

                    let second = escapeCsv(item.querySelector('[data-csv-value]').innerText);

                    csvArray.push('"' + first + '"' + ',' + '"' + second + '"')

                });
                that.exportCsvOperation(csvArray);

            })

        });
    }
}).$mount('#appoo')


function escapeCsv(col) {
    let data = col.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
    data = data.replace(/"/g, '""');
    return data;
}
