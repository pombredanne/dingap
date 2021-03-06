
Name: app-firewall-custom
Version: 6.2.0.beta3
Release: 1%{dist}
Summary: Custom Firewall
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = %{version}-%{release}
Requires: app-base
Requires: app-firewall-core

%description
Allows customized firewall rules to be added.

%package core
Summary: Custom Firewall - APIs and install
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core

%description core
Allows customized firewall rules to be added.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/firewall_custom
cp -r * %{buildroot}/usr/clearos/apps/firewall_custom/


%post
logger -p local6.notice -t installer 'app-firewall-custom - installing'

%post core
logger -p local6.notice -t installer 'app-firewall-custom-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/firewall_custom/deploy/install ] && /usr/clearos/apps/firewall_custom/deploy/install
fi

[ -x /usr/clearos/apps/firewall_custom/deploy/upgrade ] && /usr/clearos/apps/firewall_custom/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-firewall-custom - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-firewall-custom-core - uninstalling'
    [ -x /usr/clearos/apps/firewall_custom/deploy/uninstall ] && /usr/clearos/apps/firewall_custom/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/firewall_custom/controllers
/usr/clearos/apps/firewall_custom/htdocs
/usr/clearos/apps/firewall_custom/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/firewall_custom/packaging
%exclude /usr/clearos/apps/firewall_custom/tests
%dir /usr/clearos/apps/firewall_custom
/usr/clearos/apps/firewall_custom/deploy
/usr/clearos/apps/firewall_custom/language
/usr/clearos/apps/firewall_custom/libraries
