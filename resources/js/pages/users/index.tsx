import {InfiniteScroll} from "@inertiajs/react";
import { ListItemGroup } from '@/components/list-item-group';
import { user } from '@/schemas';
import type {CursorPaginatedResponse, User} from "@/types";

export default function ({ users }: { users: CursorPaginatedResponse<User> }) {
    return (
        <InfiniteScroll data="users">
            <ListItemGroup
                data={users.data}
                propKey="users"
                schema={user}
            />
        </InfiniteScroll>
    );
}
