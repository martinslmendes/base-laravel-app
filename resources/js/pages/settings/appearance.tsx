import { Head } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';
import AppearanceTabs from '@/components/appearance-tabs';
import Heading from '@/components/heading';
import { edit as editAppearance } from '@/routes/appearance';

export default function Appearance() {
    const { t } = useTranslation();
    const title = t('Appearance settings');

    return (
        <>
            <Head title={title} />

            <h1 className="sr-only">{title}</h1>

            <div className="space-y-6">
                <Heading
                    variant="small"
                    title={title}
                    description={t("Update your account's appearance settings")}
                />
                <AppearanceTabs />
            </div>
        </>
    );
}

Appearance.layout = {
    breadcrumbs: [
        {
            title: 'Appearance settings',
            href: editAppearance(),
        },
    ],
};
