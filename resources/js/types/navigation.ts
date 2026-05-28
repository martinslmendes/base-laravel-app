import type { InertiaLinkProps } from '@inertiajs/react';
import type { LucideIcon } from 'lucide-react';
import type { ReactNode } from 'react';

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export interface CursorPaginatedResponse<T> {
    data: T[];
    next_cursor?: string;
    next_page_url?: string;
    path: string;
    per_page: number;
    prev_cursor?: string;
    prev_page_url?: string;
}

export type ItemSchema<T> = {
    media?: (row: T) => ReactNode;
    title: (row: T) => ReactNode;
    description?: (row: T) => ReactNode;
    fields?: ItemField<T>[];
    actions?: (row: T) => ReactNode;
};

export type ItemField<T> = {
    key: string;
    label?: string;
    render: (row: T) => ReactNode;
};

export type SoftDeletable = {
    uuid: string;
    name?: string;
    deleted_at?: string | null;
};

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
};
