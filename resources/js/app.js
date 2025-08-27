import './bootstrap';

import Alpine from 'alpinejs';

import * as FilePond from 'filepond';
import ar_AR from "filepond/locale/ar-ar.js";
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import flatpickr from "flatpickr";
import { Arabic } from "flatpickr/dist/l10n/ar.js";

window.FilePond = FilePond

FilePond.setOptions(ar_AR);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginImagePreview);

flatpickr.localize(Arabic);
window.flatpickr = flatpickr;

window.Alpine = Alpine;

Alpine.start();
