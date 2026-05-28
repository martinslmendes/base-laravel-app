import { LocalizedTimestamp } from '@/components/ui/localized-timestamp';
import UserAvatar from '@/components/ui/user-avatar';
import type { ItemSchema, User } from '@/types';

export const user: ItemSchema<User> = {
    media: (user) => <UserAvatar user={user} />,
    title: (user) => user.name,
    description: (user) => user.email,
    fields: [
        {
            key: 'created_at',
            label: 'Created at',
            render: (user) => (
                <LocalizedTimestamp timestamp={user.created_at} />
            ),
        },
    ],
    actions: (user) => (
        <>
            {/* TODO user actions menu */}
        </>
    ),
};
