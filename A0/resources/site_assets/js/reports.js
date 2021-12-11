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
            defaultPredefinedMessages: window.defaultPredefinedMessages,
            predefinedMessage: '',
            selectedPredefined: null,
            // editor:ClassicEditor,
            // editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // plugins: [ Font ],
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
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
            countries: window.countries,
            collectionLocations: window.collectionLocations,
            selectedFromCountries: window.selectedFromCountries || [],
            selectedToCountries: window.selectedToCountries || [],
            selectedCollectionLocations: window.selectedCollectionLocations || [],
            mailSubject: '',
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
        privateAppendPlaceHolder() {

        },
        emailToSelectedEmails() {
            let emails = [];
            let finalInfo = [];

            this.selectedEmail.forEach(item => {
                let email = document.querySelector(`[data-${item}-email]`).innerText;

                if (!emails.includes(email) && this.validateEmail(email)) {

                    let address = document.querySelector(`[data-${item}-address]`).innerText;
                    let zipcode = document.querySelector(`[data-${item}-zipcode]`).innerText;
                    let contact_person = document.querySelector(`[data-${item}-contact_person]`).innerText;
                    let company_name = document.querySelector(`[data-${item}-company_name]`).innerText;
                    let telephone = document.querySelector(`[data-${item}-telephone]`).innerText;
                    let country = document.querySelector(`[data-${item}-country]`).innerText;

                    emails.push(email);

                    finalInfo.push({
                        email,
                        address,
                        zipcode,
                        contact_person,
                        company_name,
                        telephone,
                        country,
                    });
                }
            });
            Swal.fire({
                grow: 'fullscreen',
                html: this.$refs.reportModal,
                showCloseButton: true,
                showCancelButton: true,
                didOpen: (toast) => {
                    setTimeout(() => {
                        // if (!this.emailSwalOpened) {

                        let editor = CKEDITOR.replace('message');
                        let config = editor.config;

                        editor.ui.addRichCombo('widgets', {
                            label: "Place Holders", // label displayed in toolbar
                            title: 'Insert Place Holder', // tooltip text when hovering over the dropdown
                            multiSelect: false,
                            toolbar: 'insert',
                            className: 'cke_place_holder',
                            // use the same style as the font/style dropdowns
                            panel: {
                                css: `.ckeditor-custom-6{font-size: 10px;display : inline;}
`,
                            },

                            init: function () {
                                // dropdown options:
                                // this.add( VALUE, HTML, TEXT );
                                // VALUE - The value we get when the row is clicked
                                // HTML - html/plain text that should be displayed in the dropdown
                                // TEXT - displayed in popup when hovered over the row.
                                this.add("<b>{CompanyName}</b>", "<h6 class='ckeditor-custom-6'>company name</h6>", "{CompanyName}");
                                this.add("<b>{Address}</b>", "<h6 class='ckeditor-custom-6'>Address</h6>", "{Address}");
                                this.add("<b>{ZipCode}</b>", "<h6 class='ckeditor-custom-6'>Zip Code</h6>", "{ZipCode}");
                                this.add("<b>{ContactPerson}</b>", "<h6 class='ckeditor-custom-6'>Contact Person</h6>", "{Contact Person}");
                                this.add("<b>{Telephone}</b>", "<h6 class='ckeditor-custom-6'>Telephone</h6>", "{Telephone}");
                            },
                            onClick: function (value) {
                                editor.insertHtml(value);
                            },
                        });
                        return

                        editor.addRichCombo("mySimpleCommand", { // create named command
                            exec: function (edt, xx, yy) {
                                // CKEDITOR.instances.message.insertHtml('<a href=\x22my_link\x22>XXXXXXXXXXXXX' + CKEDITOR.instances.message.getSelection().getNative() + '</a>');
                                editor.insertHtml('XXXXXXXXXXXXX');
                                return
                                debugger
                                var fragment = editor.getSelection().getRanges()[0].extractContents()
                                var container = CKEDITOR.dom.element.createFromHtml("asdasdasd", editor.document)
                                fragment.appendTo(container)
                                editor.insertElement(container)
                                // alert(edt.getData());
                            }
                        });

                        editor.ui.addButton('SuperButton', { // add new button and bind our command
                            label: "Click me",
                            command: 'mySimpleCommand',
                            // toolbar: 'insert',
                            // icon: 'insert Company Name'
                        });
                        // this.emailSwalOpened = true;
                        //
                        // }else{
                        //     CKEDITOR.instances['message'].updateElement();
                        // }
                    }, 10)
                }
            }).then(result => {
                const mailtext = CKEDITOR.instances.message.getData();
                // debugger

                if (CKEDITOR.instances.message) CKEDITOR.instances.message.destroy();

                if (result.isConfirmed) {
                    axios.post('/admin/report/email-to-report-users', {
                        _token,
                        payload: finalInfo,
                        mailSubject: this.mailSubject,
                        mailtext,
                    }).then(result => {
                        Swal.fire({
                            icon: 'success',
                            text: 'Mails has been sent successfully',
                        })
                    }).catch(error => {

                    })
                }
            })
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
        saveInDatabase(e,quoteId) {
            e.preventDefault();

            const payload = {};

            payload.senderAddress = document.querySelector(`[data-sender-${quoteId}-address]`).innerText;
            payload.senderZipcode = document.querySelector(`[data-sender-${quoteId}-zipcode]`).innerText;
            payload.senderContactPerson = document.querySelector(`[data-sender-${quoteId}-contact_person]`).innerText;
            payload.senderCompanyName = document.querySelector(`[data-sender-${quoteId}-company_name]`).innerText;
            payload.senderTelephone = document.querySelector(`[data-sender-${quoteId}-telephone]`).innerText;
            payload.senderCountry = document.querySelector(`[data-sender-${quoteId}-country]`).innerText;
            payload.senderEmail = document.querySelector(`[data-sender-${quoteId}-email]`).innerText;

            payload.receiverAddress = document.querySelector(`[data-receiver-${quoteId}-address]`).innerText;
            payload.receiverContactPerson = document.querySelector(`[data-receiver-${quoteId}-contact_person]`).innerText;
            payload.receiverCompanyName = document.querySelector(`[data-receiver-${quoteId}-company_name]`).innerText;
            payload.receiverTelephone = document.querySelector(`[data-receiver-${quoteId}-telephone]`).innerText;
            payload.receiverCountry = document.querySelector(`[data-receiver-${quoteId}-country]`).innerText;
            payload.receiverEmail = document.querySelector(`[data-receiver-${quoteId}-email]`).innerText;

            Swal.fire({
                icon: 'info',
                showCancelButton: true,
                html: 'you are about to change the shipping information for quote number ' +
                    quoteId + ".<br>" +' do you confirm this operation?'

            }).then(result => {
                if (result.isConfirmed) {
                    axios.post('/admin/report/save-shipping-info', {
                        _token,
                        quoteId,
                        payload,
                    }).then(({data}) => {
                        Swal.fire({
                            icon: data.status === 'ok' ? 'success' : 'error',
                            text: data.text
                        })
                    }).catch(error => {

                    })
                }

            })

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
            vm.selectedUser = null;

            axios.get(window.reportUserApi + `?q=${escape(search)}`).then(res => {
                vm.options = res.data
                loading(false)

            }).catch(err => {

            })
        }, 350)
    },
    watch: {
        predefinedMessage(messageId) {
            this.selectedPredefined = this.defaultPredefinedMessages.find(msg => msg.id === messageId);

            CKEDITOR.instances.message.setData(this.selectedPredefined.message);
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

