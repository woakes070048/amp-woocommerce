#!/usr/bin/env bash

set -e

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
	echo "Not deploying pull requests."
	exit
fi

if [[ ! $WP_PULUGIN_DEPLOY ]]; then
	echo "Not deploying."
	exit
fi

if [[ ! $SVN_REPO ]]; then
	echo "SVN repo is not specified."
	exit
fi
TRAVIS_TAG="beta"
SVN_USER="$WP_ORG_USERNAME"
SVN_PASS="$WP_ORG_PASSWORD"
# Untrailing slash of SVN_REPO path
SVN_REPO=`echo $SVN_REPO | sed -e "s/\/$//"`
# Git repository
GH_REF=https://github.com/${TRAVIS_REPO_SLUG}.git

echo "Starting deploy..."

mkdir build

cd build
BASE_DIR=$(pwd)

echo "Checking out beta from $SVN_REPO ..."
#cd $SVN_REPO 
# svn co -q $SVN_REPO
# mkdir trunk
svn co -q $SVN_REPO
ls
echo "create directory"
mkdir temp
ls
#svn commit --no-auth-cache --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD -m "Deploy version"
svn commit -m "commit to create directory" --username $SVN_USER --password $SVN_PASS --non-interactive 2>/dev/null
echo "directory created"






# echo "deleting previous directory"
# rm --force $SVN_REPO/tags/beta
# mkdir beta
# svn co -q $SVN_REPO/tags/beta
# echo "Getting clone from $GH_REF to $SVN_REPO ..."
# git clone -q $GH_REF ./git

# cd ./git

# if [ -e "bin/build.sh" ]; then
# 	echo "Starting bin/build.sh."
# 	bash bin/build.sh
# fi

# cd $BASE_DIR

# echo "Syncing git repository to svn"
# rsync -a --exclude=".svn" --checksum --delete ./git/ ./beta/
# rm -fr ./git

# cd ./beta

# if [ -e ".distignore" ]; then
# 	echo "svn propset form .distignore"
# 	svn propset -q -R svn:ignore -F .distignore .

# else
# 	if [ -e ".svnignore" ]; then
# 		echo "svn propset"
# 		svn propset -q -R svn:ignore -F .svnignore .
# 	fi
# fi
# echo "Ignoring GitHub specific files"
# # svn propset svn:ignore "README.md
# # Thumbs.db
# # .github/*
# # .git
# # .gitattributes
# # .gitignore" $SVN_REPO/tags/beta/
# echo "Run svn add"
# svn st | grep '^!' | sed -e 's/\![ ]*/svn del -q /g' | sh
# echo "Run svn del"
# svn st | grep '^?' | sed -e 's/\?[ ]*/svn add -q /g' | sh

# # If tag number and credentials are provided, commit to trunk.
# if [[ $TRAVIS_TAG && $SVN_USER && $SVN_PASS ]]; then
# 	if [[ ! -d tags/$TRAVIS_TAG ]]; then
# 		echo "Commit to $SVN_REPO."
# 		svn commit -m "commit version $TRAVIS_TAG" --username $SVN_USER --password $SVN_PASS --non-interactive 2>/dev/null
# 		echo "Take snapshot of $TRAVIS_TAG"
# 		#svn copy $SVN_REPO/trunk $SVN_REPO/tags/$TRAVIS_TAG -m "Take snapshot of $TRAVIS_TAG" --username $SVN_USER --password $SVN_PASS --non-interactive 2>/dev/null
# 	else
# 		echo "tags/$TRAVIS_TAG already exists."
# 	fi
# else
# 	echo "Nothing to commit and check \`svn st\`."
# 	svn st
# fi
