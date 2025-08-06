import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import { ChevronRight, Home } from 'lucide-react';

const Breadcrumb = () => {
  const location = useLocation();
  const pathnames = location.pathname.split('/').filter((x) => x);

  // Don't show breadcrumb on homepage
  if (location.pathname === '/') {
    return null;
  }

  const breadcrumbNameMap: { [key: string]: string } = {
    'movies': 'Films',
    'series': 'Series',
    'shop': 'Shop',
    'jobs': 'Careers',
    'events': 'Events',
    'articles': 'Articles',
    'movie': 'Film',
    'article': 'Article',
    'event': 'Event',
    'job': 'Job',
    'casting': 'Casting',
    'product': 'Product',
    'membership': 'Membership'
  };

  // Function to build the correct path for each breadcrumb segment
  const buildPath = (index: number) => {
    return `/${pathnames.slice(0, index + 1).join('/')}`;
  };

  // Function to determine if a breadcrumb should be clickable
  const isClickable = (index: number) => {
    const isLast = index === pathnames.length - 1;
    const segment = pathnames[index];
    
    // Don't make the last item clickable (current page)
    if (isLast) return false;
    
    // Don't make dynamic route segments clickable (like specific IDs)
    // These are typically the second-to-last segments in detail pages
    const isDetailPage = pathnames.length > 1 && index === pathnames.length - 2;
    const parentSegment = index > 0 ? pathnames[index - 1] : '';
    
    // If this is a detail page and the current segment is not in our name map,
    // it's likely a dynamic ID, so don't make it clickable
    if (isDetailPage && !breadcrumbNameMap[segment] && 
        (parentSegment === 'movie' || parentSegment === 'series' || 
         parentSegment === 'article' || parentSegment === 'event' ||
         parentSegment === 'job' || parentSegment === 'casting' ||
         parentSegment === 'product')) {
      return false;
    }
    
    return true;
  };

  // Function to get the correct link path for breadcrumb navigation
  const getBreadcrumbPath = (segment: string, index: number) => {
    // For known route segments, use their standard paths
    if (breadcrumbNameMap[segment]) {
      // Special handling for route mapping
      if (segment === 'movie') {
        return '/movies'; // movie detail should link back to movies listing
      } else if (segment === 'series') {
        return '/series'; // series detail should link back to series listing
      } else if (segment === 'movies' || segment === 'articles' || segment === 'events' || segment === 'jobs' || segment === 'shop') {
        return `/${segment}`;
      }
    }
    
    // For other segments, use the built path
    return buildPath(index);
  };

  // Function to get display name for breadcrumb
  const getDisplayName = (segment: string, index: number) => {
    // Check if this is a known route segment
    if (breadcrumbNameMap[segment]) {
      return breadcrumbNameMap[segment];
    }
    
    // For dynamic segments (IDs), try to get a more readable name
    const parentSegment = index > 0 ? pathnames[index - 1] : '';
    
    // If this is an ID segment, show a generic name
    if (parentSegment === 'event') {
      return 'Event Detail';
    } else if (parentSegment === 'movie') {
      return 'Film Detail';
    } else if (parentSegment === 'series') {
      return 'Series Detail';
    } else if (parentSegment === 'article') {
      return 'Article Detail';
    } else if (parentSegment === 'product') {
      return 'Product Detail';
    } else if (parentSegment === 'job') {
      return 'Job Detail';
    } else if (parentSegment === 'casting') {
      return 'Casting Detail';
    }
    
    // Default: capitalize first letter
    return segment.charAt(0).toUpperCase() + segment.slice(1);
  };

  return (
    <nav className="absolute top-24 left-6 lg:left-8 z-30">
      <ol className="flex items-center space-x-2 text-sm">
        <li>
          <Link 
            to="/" 
            className="text-gray-500 hover:text-gray-700 transition-colors duration-300 flex items-center"
          >
            <Home className="h-3 w-3" />
          </Link>
        </li>
        {pathnames.map((value, index) => {
          const isLast = index === pathnames.length - 1;
          const clickable = isClickable(index);
          const displayName = getDisplayName(value, index);
          const linkPath = getBreadcrumbPath(value, index);

          return (
            <React.Fragment key={linkPath}>
              <ChevronRight className="h-3 w-3 text-gray-400" />
              <li>
                {clickable ? (
                  <Link 
                    to={linkPath} 
                    className="text-gray-500 hover:text-gray-700 transition-colors duration-300"
                  >
                    {displayName}
                  </Link>
                ) : (
                  <span className={`${isLast ? 'text-gray-700 font-medium' : 'text-gray-500'}`}>
                    {displayName}
                  </span>
                )}
              </li>
            </React.Fragment>
          );
        })}
      </ol>
    </nav>
  );
};

export default Breadcrumb;