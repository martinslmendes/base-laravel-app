import pt_BR from '@lang/pt_BR.json';
import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

i18n.use(initReactI18next).init({
    fallbackLng: 'en',
    resources: {
        pt_BR: { translation: pt_BR },
    },
    lng: localStorage.getItem('locale'),
    interpolation: {
        escapeValue: false,
    },
});

export default i18n;
