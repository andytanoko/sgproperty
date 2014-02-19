#!/bin/sh
echo -e "Content-type: text/plain\n\n"

################################################################################################################
# RESTRICTED SHEL
#  -changing directories with c
#  -setting or unsetting the values of SHELL, PATH, ENV, or BASH_EN
#  -specifying command names containing 
#  -specifying a file name containing a / as an argument to the .  builtin comman
#  -Specifying a filename containing a slash as an argument to the -p option to the hash builtin comman
#  -importing function definitions from the shell environment at startu
#  -parsing the value of SHELLOPTS from the shell environment at startu
#  -redirecting output using the >, >|, <>, >&, &>, and >> redirection operator
#  -using the exec builtin command to replace the shell with another comman
#  -adding or deleting builtin commands with the -f and -d options to the enable builtin comman
#  -Using the enable builtin command to enable disabled shell builtin
#  -specifying the -p option to the command builtin comman
#  -turning off restricted mode with set +r or set +o restricted
################################################################################################################





# FUNCTIONS
################################################################################################################
function __A ()
{ local __a __i __z;for __a;do __z=\${!${__a}*};for __i in `eval echo "${__z}"`;do echo -e "$__i: ${!__i}";done;done; }

function __S ()
{ local L IFS=';';while read -r L;do builtin printf "${#L}@%s\n" "$L";done|sort -n|sed -u 's/^[^@]*@//'; }

function __P ()
{ local l=`builtin printf %${2:-$__WIDTH}s` && echo -e "${l// /${1:-=}}"; }

function __CT ()
{ echo -e "\n"; }

function __TT ()
{ echo -e "\n\n$*"; }

function __T ()
{ echo -e "\n\n+`__P -`+\n| $*\n+`__P '='`+"; }

function __M ()
{ echo -e " >>> $M" $*; }

function __H ()
{ command builtin type $1 &>/dev/null && local a="yes" || return 1; }

function LE ()
{
   [ ! -r /proc/${1:-$$}/limits ]] && return;
   sed -e '1z;s/ *$//;:a;$!N;s/\nM.. [a-z]* [a-z]* [a-z]* \{1,\}\([^ ]*\) *\([^ ]*\) *[a-z]* */\1:\2 /;ta;s/u\w\+d/u/g;s/ *$//;s/ / | /g;s/\([^:]\+\):\1/\1:=/g' /proc/${1:-$$}/limits;
}

function LH ()
{
   [[ ! -r /proc/${1:-$$}/limits ]] && return;
   sed -e '1z;s/ *$//;:a;$!N;s/\nM.. \([a-z]\+ [a-z]* [a-z]*\) \{1,\}\([^ ]*\) *\([^ ]*\) *\([a-z]*\) */:\1/;ta;s/ *:/:/g;s/size/sz/g;s/file/f/g;s/ p\w\+y/ pri/g;s/memory/mem/g;s/p\w\+s/procs/g;s/^://;s/:/ | /g' /proc/${1:-$$}/limits
}




# CUSTOM SETTINGS
################################################################################################################
__WIDTH=170
LC_COLLATE=C LC_CTYPE=C LC_ALL=C



# RUNTIME SETUP
#################################################################################################################
shopt -s dotglob nocaseglob extglob

# -C If set, disallow existing regular files to be overwritte
# -f Disable file name generation (globbing
# -e Exit immediately if a command exits with a non-zero status
# -B enable brace expansion 
# +H disable History
set -C +f +H -B

# make sure we dont create any files
umask 0177

# redirect everything to output (no logs or stderr is used)
exec 2>/dev/null








# MAIN EXECUTION
#################################################################################################################
{

	__T "EXPANDING PATH"
	{
		__M "ORIG PATH:$PATH"
		PATH=$PATH:/usr/local/bin:/usr/bin:/bin:/usr/local/sbin:/usr/sbin:/sbin:/usr/libexec:/usr/local/apache/bin

		for t in ${PATH//:/ };
		do
			[[ -d "$t" ]] && sed -n -e "/:${t//\//\\/}:/Q1" <<< ":${p:=}:" && p=$p:$t || continue;
		done

		PATH=${p/:/}:.
		__M "NEW PATH:$PATH"
	}
	__CT



	__T "USER INFO"
	{
		__M "UMASK: `(umask 2>/dev/null)` ( `(umask -S 2>/dev/null)` )"
		__H uname && __M "UNAME: `eval echo $(uname -a 2>/dev/null)`"
		__H whoami && __M "WHOAMI: `(whoami 2>/dev/null)`"
		__H id && __M "ID: `(id 2>/dev/null)`"
		__H logname && __M "LOGNAME: `(logname 2>/dev/null)`"
		__H groups && __M "GROUPS: `(groups 2>/dev/null)`"
		__H lastlog && __M "LASTLOG: " && (lastlog 2>/dev/null)
	}
	__CT


	if __H who;
	then
		__T "LOGGED ON USERS"
		{
			(who -a 2>/dev/null)
		}
		__CT
	fi;



	if [[ -r /etc/passwd ]];
	then
		__T "/etc/passwd"
		{
			(cat /etc/passwd)
		}
		__CT
	fi;



	if __H ulimit;
	then
		__T "USER LIMITS"
		{
			ulimit -a
		}
		__CT
	fi



	if [[ -d /dev ]] && __H ls;
	then
		__T "/dev Directory"
		{
			( ls -vlaph /dev 2>/dev/null | column -c$__WIDTH -t)
		}
		__CT

	fi;



	__T "IP INFORMATION"
	{
		__H ip && __M "IP:" && (ip -o -f inet addr 2>/dev/null) | sed 's/^.*inet \([0-9.]*\).*$/\1/g';
		__H nmap && __M "NMAP:" && (nmap --iflist 2>/dev/null) | sed 1,4d | sed -n '/ethernet/s/^.*) \([0-9.]*\).*$/\1/gp';
		__H ifconfig && __M "IFCONFIG:" && (ifconfig -a 2>/dev/null) | sed -n '/inet a/s/^.*addr:\([0-9.]*\).*$/\1/gp';
		[[ -f "$HOME/.cpanel/datastore/_sbin_ifconfig_-a" ]] && __M "CPANEL CACHE:" && sed -e '/inet/!d; s/.*addr:\([0-9\.]*\).*/\1/g' "$HOME/.cpanel/datastore/_sbin_ifconfig_-a" | sort -u

	}
	__CT


	__T "ROUTE / INTERFACE INFO"
	{
		__H route && __M "ROUTE" && (route -nv 2>/dev/null)
		__H ip && ( ip rule && ip route && ip address ) 2>/dev/null
		__H ifconfig && (ifconfig -a 2>/dev/null)
	}
	__CT



	__T "CGI/1.0 test script report:"
	{
		__A SERVER REQUEST GET SERVER PATH REMOTE AUTH CONTENT HTTP TZ GATEWAY QUERY MO
	}
	__CT




	__T "HIDDEN VARIABLES"
	{
		__A {a..z} {A..Z} _{0..9} _{A..Z} _{a..z} | cat -Tsv 2>/dev/null
	}
	__CT



	__T "DECLARE INFO"
	{
		for i in "r" "i" "a" "x" "t" "-";
		do
			builtin eval declare -$i && echo;
		done | sed 's/^declare //' | cat -Tsv 2>/dev/null
	}
	__CT


	__T "SHELL OPTIONS"
	{
		__A SHELLOPTS BASHOPTS
		echo -e "\$-: $-"
		__P '-' && builtin shopt -s -p
		__P '-' && builtin shopt -u -p
	}
	__CT


	__T "ENV AND EXPORT"
	{
		__H env && command env | cat -Tsv 2>/dev/null && __P '-'
		builtin export | cat -Tsv 2>/dev/null
	}
	__CT



	if __H perl;
	then
		__T "PERL VARIABLES"
		{
			perl -e'foreach $v (sort(keys(%ENV))) {$vv = $ENV{$v};$vv =~ s|\n|\\n|g;$vv =~ s|"|\\"|g;print "${v}=\"${vv}\"\n"}' | cat -Tsv 2>/dev/null
		}
		__CT
	fi


	if [[ -d /proc ]];
	then
		__T "CURRENT PROCESS LIMITS"
		{
			for p in `echo /proc/[0-9]*/limits`
			do
				pid=${p:6:$((${#p}-13))}
				[[ $pid == $PPID || $pid == $$ ]] && continue;
				echo -e "\n/proc/$pid:"
				sed '1s/\x00/ /g;n;s/\x00/\n/g;/.\{2,\}/!d' /proc/$pid/cmdline $p 2>/dev/null
			done
		}
		__CT

		__T "CURRENT PROCESS CMDLINE"
		{
			for p in `echo /proc/[0-9]*/cmdline`;
			do
				pid=${p:6:$((${#p}-13))}
				[[ $pid == $PPID || $pid == $$ ]] && continue;
				__M "[ /proc/$pid ]";
				sed 's/\x00/ /g;G' $p 2>/dev/null
			done
		}
		__CT
	fi

} 
#| tr -s "\n\t " 
#| /usr/bin/fold - -w$(($__WIDTH+3))

exit $?
