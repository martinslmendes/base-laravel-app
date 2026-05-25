import pt_BR from '@lang/pt_BR.json';
import i18n from 'i18next';
import LanguageDetector from 'i18next-browser-languagedetector';
import Backend from 'i18next-http-backend';
import { initReactI18next } from 'react-i18next';

i18n.use(Backend)
    .use(LanguageDetector)
    .use(initReactI18next)
    .init({
        fallbackLng: 'en',
        supportedLngs: ['en', 'pt'],
        debug: import.meta.env.VITE_APP_DEBUG === 'true',
        detection: {
            lookupLocalStorage: 'locale',
        },
        resources: {
            pt: { translation: pt_BR },
        },
    });

export default i18n;
