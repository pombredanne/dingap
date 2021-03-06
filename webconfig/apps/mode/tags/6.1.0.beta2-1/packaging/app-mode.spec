
Name: app-mode-core
Group: ClearOS/Libraries
Version: 6.1.0.beta2
Release: 1%{dist}
Summary: Translation missing (mode_base_system_mode) - APIs and install
License: LGPLv3
Packager: ClearFoundation
Vendor: ClearFoundation
Source: app-mode-%{version}.tar.gz
Buildarch: noarch
Requires: app-base-core
Requires: system-mode-driver

%description
Translation missing (mode_app_long_description)

This package provides the core API and libraries.

%prep
%setup -q -n app-mode-%{version}
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/mode
cp -r * %{buildroot}/usr/clearos/apps/mode/

install -d -m 0755 %{buildroot}/var/clearos/mode
install -D -m 0644 packaging/mode.conf %{buildroot}/var/clearos/mode

%post
logger -p local6.notice -t installer 'app-mode-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/mode/deploy/install ] && /usr/clearos/apps/mode/deploy/install
fi

[ -x /usr/clearos/apps/mode/deploy/upgrade ] && /usr/clearos/apps/mode/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-mode-core - uninstalling'
    [ -x /usr/clearos/apps/mode/deploy/uninstall ] && /usr/clearos/apps/mode/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
%exclude /usr/clearos/apps/mode/packaging
%exclude /usr/clearos/apps/mode/tests
%dir /usr/clearos/apps/mode
%dir /var/clearos/mode
/usr/clearos/apps/mode/deploy
/usr/clearos/apps/mode/language
/usr/clearos/apps/mode/libraries
%config(noreplace) /var/clearos/mode
