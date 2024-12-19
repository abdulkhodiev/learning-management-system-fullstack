<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { Collapsible } from "@/components/ui/collapsible"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Separator } from "@/components/ui/separator"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarHeader,
  SidebarInset,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarProvider,
  SidebarRail,
  SidebarTrigger,
} from "@/components/ui/sidebar"
import {
  AlignLeftIcon,
  ArrowLeft,
  AudioWaveform,
  BadgeCheck,
  Bell,
  Book,
  CircleDollarSign,
  CircleGauge,
  Command,
  CreditCard,
  GalleryVerticalEnd,
  LayoutList,
  LogOut,
  Mails,
  Settings,
  ShieldPlus,
  Sparkles,
  UserRoundCog,
  UsersIcon,
} from "lucide-vue-next"
import { ref } from "vue"
import { Toaster } from "@/components/ui/sonner"

const data = {
  user: {
    name: "shadcn",
    email: "m@example.com",
    avatar: "/avatars/shadcn.jpg",
  },
  teams: [
    {
      name: "Acme Inc",
      logo: GalleryVerticalEnd,
      plan: "Enterprise",
    },
    {
      name: "Acme Corp.",
      logo: AudioWaveform,
      plan: "Startup",
    },
    {
      name: "Evil Corp.",
      logo: Command,
      plan: "Free",
    },
  ],
  navMain: [
    {
      title: "Dashboard",
      url: "/dashboard",
      icon: CircleGauge,
      isActive: true,
    },
    {
      title: "Courses",
      url: "/courses",
      icon: Book,
    },
    {
      title: "Categories",
      url: "/categories",
      icon: LayoutList,
    },
    {
      title: "Communication",
      url: "/communication/reviews",
      icon: Mails,
    },
    {
      title: "Revenue",
      url: "#",
      icon: CircleDollarSign,
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings,
    },
    {
      title: "Users",
      url: "/users",
      icon: UsersIcon,
    },
    {
      title: "Roles",
      url: "/roles",
      icon: UserRoundCog,
    },
    {
      title: "Permissions",
      url: "/permissions",
      icon: ShieldPlus,
    },
  ],
}

const activeTeam = ref(data.teams[0])

function setActiveTeam(team: (typeof data.teams)[number]) {
  activeTeam.value = team
}

import { router, usePage } from "@inertiajs/vue3"
import { Button } from "@/components/ui/button"

const { url } = usePage()
const pathname = url

const active = "text-primary"
</script>

<template>
  <SidebarProvider>
    <Sidebar collapsible="icon" class="text-white">
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton
              size="lg"
              class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
            >
              <div
                class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg"
              >
                <SidebarTrigger :icon="true" class="h-10 w-10" />
              </div>
              <div class="grid flex-1 text-left text-sm leading-tight">
                <span class="truncate font-semibold">ByWay</span>
              </div>
              <SidebarTrigger class="-ml-1" />
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <SidebarGroup>
          <SidebarMenu>
            <Collapsible
              v-for="item in data.navMain"
              :key="item.title"
              as-child
              :default-open="item.isActive"
              class="group/collapsible"
            >
              <SidebarMenuItem
                class="hover:text-primary"
                @click="router.get(item.url)"
                :class="pathname.includes(item.url) ? active : ''"
              >
                <SidebarMenuButton :tooltip="item.title">
                  <div>
                    <component :is="item.icon" class="size-5" />
                  </div>
                  <span>{{ item.title }}</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
            </Collapsible>
          </SidebarMenu>
        </SidebarGroup>
      </SidebarContent>
      <SidebarFooter>
        <SidebarMenu>
          <SidebarMenuItem>
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <SidebarMenuButton
                  size="lg"
                  class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                >
                  <Avatar class="h-8 w-8 rounded-lg">
                    <AvatarImage
                      :src="data.user.avatar"
                      :alt="data.user.name"
                    />
                    <AvatarFallback class="rounded-lg"> CN </AvatarFallback>
                  </Avatar>
                  <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{
                      data.user.name
                    }}</span>
                    <span class="truncate text-xs">{{ data.user.email }}</span>
                  </div>
                  <AlignLeftIcon class="ml-auto size-4" />
                </SidebarMenuButton>
              </DropdownMenuTrigger>
              <DropdownMenuContent
                class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
                side="bottom"
                align="end"
                :side-offset="4"
              >
                <DropdownMenuLabel class="p-0 font-normal">
                  <div
                    class="flex items-center gap-2 px-1 py-1.5 text-left text-sm"
                  >
                    <Avatar class="h-8 w-8 rounded-lg">
                      <AvatarImage
                        :src="data.user.avatar"
                        :alt="data.user.name"
                      />
                      <AvatarFallback class="rounded-lg"> CN </AvatarFallback>
                    </Avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                      <span class="truncate font-semibold">{{
                        data.user.name
                      }}</span>
                      <span class="truncate text-xs">{{
                        data.user.email
                      }}</span>
                    </div>
                  </div>
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuGroup>
                  <DropdownMenuItem>
                    <Sparkles />
                    Upgrade to Pro
                  </DropdownMenuItem>
                </DropdownMenuGroup>
                <DropdownMenuSeparator />
                <DropdownMenuGroup>
                  <DropdownMenuItem>
                    <BadgeCheck />
                    Account
                  </DropdownMenuItem>
                  <DropdownMenuItem>
                    <CreditCard />
                    Billing
                  </DropdownMenuItem>
                  <DropdownMenuItem>
                    <Bell />
                    Notifications
                  </DropdownMenuItem>
                </DropdownMenuGroup>
                <DropdownMenuSeparator />
                <DropdownMenuItem>
                  <LogOut />
                  Log out
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarFooter>
      <SidebarRail />
    </Sidebar>
    <SidebarInset>
      <header
        class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 sm:block md:hidden"
      >
        <div class="flex items-center gap-2 px-4">
          <SidebarTrigger class="-ml-1" />
          <Separator orientation="vertical" class="mr-2 h-4" />
        </div>
      </header>
      <div class="flex flex-1 flex-col gap-4 p-4">
        <div class="flex items-center justify-between">
          <h1>Course Name</h1>
          <Button as-child>
            <Link href="/courses"> Back <ArrowLeft /></Link>
          </Button>
        </div>
        <div>
          <div
            class="flex flex-wrap items-center justify-center gap-4 pb-0 md:justify-start"
          >
            <Link
              href="commissions"
              class="pb-2 text-sm hover:text-primary"
              :class="
                pathname.includes('commissions')
                  ? 'border-b-[2px] border-primary text-primary'
                  : ''
              "
            >
              Commissions
            </Link>
            <Link
              href="reviews"
              class="pb-2 text-sm hover:text-primary"
              :class="
                pathname.includes('reviews')
                  ? 'border-b-[2px] border-primary text-primary'
                  : ''
              "
            >
              Reviews
            </Link>
            <Link
              href="chapters"
              class="pb-2 text-sm hover:text-primary"
              :class="
                pathname.includes('chapters')
                  ? 'border-b-[2px] border-primary text-primary'
                  : ''
              "
            >
              Chapters
            </Link>
            <Link
              href="coupons"
              class="pb-2 text-sm hover:text-primary"
              :class="
                pathname.includes('coupons')
                  ? 'border-b-[2px] border-primary text-primary'
                  : ''
              "
            >
              Promotions
            </Link>
            <Link
              href="settings"
              class="pb-2 text-sm hover:text-primary"
              :class="
                pathname.includes('settings')
                  ? 'border-b-[2px] border-primary text-primary'
                  : ''
              "
            >
              Settings
            </Link>
          </div>
          <Separator class="mt-0 pt-0" />
        </div>
        <slot />
        <Toaster position="top-center" :rich-colors="true" />
      </div>
    </SidebarInset>
  </SidebarProvider>
</template>
