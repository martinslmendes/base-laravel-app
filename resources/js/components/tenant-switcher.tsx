import { usePage } from '@inertiajs/react';
import { Check, ChevronsUpDown, Users } from 'lucide-react';
import { useTranslation } from 'react-i18next';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { useIsMobile } from '@/hooks/use-mobile';
import type { Tenant } from '@/types';

type TenantSwitcherProps = {
    inHeader?: boolean;
};

type PageProps = {
    currentTenant?: Tenant;
    tenants: Tenant[];
};

export function TenantSwitcher({ inHeader = false }: TenantSwitcherProps) {
    const { t } = useTranslation();
    const isMobile = useIsMobile();
    const { currentTenant, tenants } = usePage<PageProps>().props;

    const switchTenant = (tenant) => {
        // TODO
    };

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button
                    variant="ghost"
                    data-test="tenant-switcher-trigger"
                    className={
                        inHeader
                            ? 'h-8 gap-1 px-2'
                            : 'w-full justify-start px-2 has-[>svg]:px-2 data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground'
                    }
                >
                    <Users
                        className={
                            inHeader
                                ? 'hidden'
                                : 'hidden size-4 shrink-0 group-data-[collapsible=icon]:block'
                        }
                    />
                    <div
                        className={
                            inHeader
                                ? 'grid flex-1 text-left text-sm leading-tight'
                                : 'grid flex-1 text-left text-sm leading-tight group-data-[collapsible=icon]:hidden'
                        }
                    >
                        <span
                            className={
                                inHeader
                                    ? 'max-w-30 truncate font-medium'
                                    : 'truncate font-semibold'
                            }
                        >
                            {currentTenant?.name ?? t('Select tenant')}
                        </span>
                    </div>
                    <ChevronsUpDown
                        className={
                            inHeader
                                ? 'size-4 opacity-50'
                                : 'ml-auto group-data-[collapsible=icon]:hidden'
                        }
                    />
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent
                className={
                    inHeader
                        ? 'w-56'
                        : 'w-(--radix-dropdown-menu-trigger-width) min-w-56 rounded-lg'
                }
                side={inHeader ? undefined : isMobile ? 'bottom' : 'right'}
                align={inHeader ? 'end' : 'start'}
                sideOffset={inHeader ? undefined : 4}
            >
                <DropdownMenuLabel className="text-xs text-muted-foreground">
                    {t('Tenants')}
                </DropdownMenuLabel>
                {tenants.map((tenant) => (
                    <DropdownMenuItem
                        key={tenant.id}
                        data-test="tenant-switcher-item"
                        className={
                            inHeader
                                ? 'cursor-pointer gap-2'
                                : 'cursor-pointer gap-2 p-2'
                        }
                        onSelect={() => switchTenant(tenant)}
                    >
                        {tenant.name}
                        {currentTenant?.id === tenant.id && (
                            <Check
                                className={
                                    inHeader
                                        ? 'ml-auto size-4'
                                        : 'ml-auto h-4 w-4'
                                }
                            />
                        )}
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
