#!/bin/bash

echo "🚀 Starting Heroku deployment..."

# Ensure we're in the right directory
cd "$(dirname "$0")"

# Add and commit changes
echo "📝 Committing changes..."
git add .
git commit -m "Deploy: Fix Heroku PHP buildpack configuration"

# Push to Heroku
echo "🔄 Pushing to Heroku..."
git push heroku main

echo "✅ Deployment complete!"
echo "🌐 Your app should be available at your Heroku URL"