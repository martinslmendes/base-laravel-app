import type { Auth } from '@/types/auth';
import type { Team } from '@/types/teams';
import type { Tenant } from '@/types/tenants';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            name: string;
            auth: Auth;
            sidebarOpen: boolean;
            currentTeam: Team | null;
            currentTenant: Tenant | null;
            teams: Team[];
            tenants: Tenant[];
            [key: string]: unknown;
        };
    }
}
