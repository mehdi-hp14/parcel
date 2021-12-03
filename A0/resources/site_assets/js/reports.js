let $ = require('jquery');
import Vue from 'vue';
import _ from 'lodash';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import axios from 'axios';
import Swal from 'sweetalert2';


Vue.component('v-select', vSelect)
// Vue.createApp( { /* options */ } ).use( CKEditor ).mount( '#appoo' );

new Vue({
// components:[VSelect],
//     components:{
//         ckeditor: CKEditor.component
//     },
    data() {
        return {
            defaultPredefinedMessages:window.defaultPredefinedMessages,
            predefinedMessage:'y',
            // editor:ClassicEditor,
            // editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // plugins: [ Font ],
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                // heading: {
                //     options: [
                //         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                //         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                //         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                //     ]
                // }
                // The configuration of the editor.

            },
            selectedCsv: [],
            selectedEmail: [],
            selectedEmailForReport: [],
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
         validateEmail(email) {
            return String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
        },
        emailToSelectedEmails(){
            let emails =[];

            this.selectedEmail.forEach(item=>{
                let email = document.querySelector(`[data-${item}]`).innerText;

                if(!emails.includes(email) && this.validateEmail(email)){
                    emails.push(email);
                }
            });
            Swal.fire({
                grow:'fullscreen',
                html: this.$refs.reportModal,
                showCloseButton:true,
                showCancelButton:true,
                didOpen:(toast) => {
                    setTimeout(()=>{
                        CKEDITOR.replace( 'message' )
                    },10)
                }
            });
            console.log(emails)
        },
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
    watch:{
        predefinedMessage(messageId){
            // console.log(this.defaultPredefinedMessages.find(msg=>msg.id===messageId).message)
            const that = this;
            // $(document).ready(function () {
                CKEDITOR.instances.message.setData(that.defaultPredefinedMessages.find(msg => msg.id === messageId).message);
            // });
        }
    },
    mounted() {
        const that = this;

    }
}).$mount('#appoo')


function escapeCsv(col) {
    let data = col.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
    data = data.replace(/"/g, '""');
    return data;
}
// "@ckeditor/ckeditor5-basic-styles": "^31.0.0",
//     "@ckeditor/ckeditor5-build-classic": "^31.0.0",
//     "@ckeditor/ckeditor5-build-decoupled-document": "^19.0.2",
//     "@ckeditor/ckeditor5-editor-classic": "^31.0.0",
//     "@ckeditor/ckeditor5-essentials": "^31.0.0",
//     "@ckeditor/ckeditor5-font": "^31.0.0",
//     "@ckeditor/ckeditor5-link": "^31.0.0",
//     "@ckeditor/ckeditor5-paragraph": "^31.0.0",
//     "@ckeditor/ckeditor5-theme-lark": "^31.0.0",
//     "@ckeditor/ckeditor5-vue": "^1.0.3",
//     "@ckeditor/ckeditor5-vue2": "^1.0.5",
//     "@mdi/font": "^5.8.55",

