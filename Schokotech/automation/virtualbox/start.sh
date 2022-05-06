#!/bin/bash
set -euxo pipefail
#set -e option will cause a bash script to exit immediately when a command fails.
#set -u option causes the bash shell to treat unset variables as an error and exit immediately.
#set -x option causes bash to print each command before executing it.
#set -o option sets the exit code of a pipeline to that of the rightmost command to exit with a non-zero status, or to zero if all commands of the pipeline exit successfully.

VM_LOGIN_NAME=${VM_LOGIN_NAME:-ubuntu}
VM_LOGIN_PASSWORD=${VM_LOGIN_PASSWORD:-1234}

shopAutomationVirtualboxDIR=$(pwd)
VBoxManage startvm Ubuntu || true

sudo apt-get install sshpass

read -p "Do you need to setup an automation login for your virtualbox? [Yy/Nn] " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
cd ~/.ssh
ssh-keygen -b 4096 -t rsa -C "schokotech-vm" -f "schokotech-vm" -N ""
eval $(ssh-agent)
ssh-add schokotech-vm
sshpass -p ${VM_LOGIN_PASSWORD} ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "echo '${VM_LOGIN_PASSWORD}'>1 sudo -S apt install ssh"
sshpass -p ${VM_LOGIN_PASSWORD} ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "cd ~ && mkdir -p .ssh"
scp -P 5679 schokotech-vm.pub ${VM_LOGIN_NAME}@127.0.0.1:~/.ssh/schokotech-vm.pub
sshpass -p ${VM_LOGIN_PASSWORD} ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "cd ~/.ssh && cat schokotech-vm.pub >> authorized_keys"
sshpass -p ${VM_LOGIN_PASSWORD} ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "echo '${VM_LOGIN_PASSWORD}'>1 sudo -S service ssh reload"
cd $shopAutomationVirtualboxDIR
fi

read -p "Do you need a new ssh key for git? [Yy/Nn] " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
cd ~/.ssh
ssh-keygen -b 4096 -t rsa -C "schokotech-vm-git" -f "schokotech-vm-git" -N ""
ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "cd ~ && mkdir -p .ssh"
scp -P 5679 schokotech-vm-git ${VM_LOGIN_NAME}@127.0.0.1:~/.ssh/schokotech-vm-git
scp -P 5679 schokotech-vm-git.pub ${VM_LOGIN_NAME}@127.0.0.1:~/.ssh/schokotech-vm-git.pub
#ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "eval \$(ssh-agent) && ssh-add ~/.ssh/schokotech-vm-git"
#ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "ssh-keyscan -t rsa,dsa git.votum-media.net >> ~/.ssh/ssh_known_hosts"

echo "Please add your public key to your git account."
echo "Public Key:"
cat schokotech-vm-git.pub

read -p "Do you want to open git? [Yy/Nn] " -n 1 -r
echo ""
if [[ $REPLY =~ ^[Yy]$ ]]
then
xdg-open https://git.votum-media.net/profile/keys 2>/dev/null
echo ""
cd $shopAutomationVirtualboxDIR
read -p "Press ENTER to continue "
fi
fi

scp -P 5679 setup.sh ${VM_LOGIN_NAME}@127.0.0.1:
ssh ${VM_LOGIN_NAME}@127.0.0.1 -p 5679 "chmod +x ~/setup.sh && ./setup.sh"
